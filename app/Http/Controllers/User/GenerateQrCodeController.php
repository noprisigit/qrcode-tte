<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateQrCodeRequest;
use App\Http\Requests\UploadLogoQrCodeRequest;
use App\Jobs\SendMailQrCodeJob;
use App\Models\QrCodeLogo;
use App\Models\Tte;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GenerateQrCodeController extends Controller
{
  public function index()
  {
    $qrcodeLogo = QrCodeLogo::where('user_id', auth()->user()->id)->first();

    return view('user.generate-qrcode.generate-qrcode-index', compact('qrcodeLogo'));
  }

  public function generate(GenerateQrCodeRequest $request)
  {
    $size = 300;

    if ($request->with_logo) {
      $qrcodeLogo = QrCodeLogo::where('user_id', auth()->user()->id)->first();
      if (!$qrcodeLogo) {
        $request->session()->flash('error', 'Logo tidak ditemukan. Silahkan upload logo terlebih dahulu.');
        return response()->json(['status' => false]);
      }

      $path = base_path('public/storage/' . $qrcodeLogo->logo);

      $qrcode = QrCode::format('png')
        ->merge($path, 0.5, true)
        ->size($size)
        ->errorCorrection('H')
        ->generate(route('link.detail.pegawai', ['unique_code' => auth()->user()->unique_code]));
      
    } else {
      $qrcode = QrCode::format('png')->size($size)->generate(route('link.detail.pegawai', ['unique_code' => auth()->user()->unique_code]));
    }

    $tte = Tte::where('user_id', auth()->user()->id)->first();
    if ($tte && $tte->qrcode) {
      Storage::delete($tte->qrcode);
    }
    
    $output_filename = '/img/qr-code/img-' . time() . '.png';
    Storage::disk('public')->put($output_filename, $qrcode);

    Tte::updateOrCreate(
      ['user_id' => auth()->user()->id],
      ['qrcode' => $output_filename]
    );

    // return response(base64_encode($qrcode))->header('Content-Type', 'image/png');
    return response()->json([
      'html' => view('user.generate-qrcode.generate-qrcode-result', compact('output_filename'))->render(),
    ]);
    // return redirect()->route('user.generate-qrcode.result', ['output_filename' => $output_filename]);
  }

  public function sendToMail(Request $request)
  {
    $image = $request->img;
    $image = str_replace('data:image/png;base64,', '', $image);
    $image = str_replace(' ', '+', $image);
    $data = base64_decode($image);

    $tte = Tte::with('user')->where('user_id', auth()->user()->id)->first();
    if ($tte) {
      Storage::delete($tte->tte);
    }

    $destinationPath = '/img/qr-code/tte-'.time().'.jpg';
    Storage::disk('public')->put($destinationPath, $data);

    Tte::updateOrCreate(
      ['user_id' => auth()->user()->id],
      [
        'user_id' => auth()->user()->id,
        'tte' => $destinationPath
      ]
    );    

    dispatch(new SendMailQrCodeJob($tte));
  
    return response()->json([
      'status' => true
    ]);
  }

  public function uploadLogo(UploadLogoQrCodeRequest $request)
  {

    $uploadedLogo = $request->file('logo');
    $filename = $uploadedLogo->store('images/logo');

    $qrcodeLogo = QrCodeLogo::where('user_id', auth()->user()->id)->first();
    if ($qrcodeLogo) {

      Storage::delete($qrcodeLogo->logo);

      $qrcodeLogo->logo = $filename;
      $qrcodeLogo->save();
    } else {

      $qrcodeLogo = new QrCodeLogo;
      $qrcodeLogo->user_id = auth()->user()->id;
      $qrcodeLogo->logo = $filename;
      $qrcodeLogo->save();
    }

    $request->session()->flash('success', 'Logo berhasil diupload.');
    return response()->json(['status' => true]);
  }
}

<?php

namespace App\Http\Controllers\PIC;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateQrCodeRequest;
use App\Http\Requests\UploadLogoQrCodeRequest;
use App\Jobs\SendMailQrCodeJob;
use App\Models\QrCodeLogo;
use App\Models\Tte;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerateQrCodeController extends Controller
{
  public function index()
  {
    $qrcodeLogo = QrCodeLogo::where('user_id', auth()->user()->id)->first();

    return view('pic.generate-qrcode.generate-qrcode-index', compact('qrcodeLogo'));
  }

  public function generate(GenerateQrCodeRequest $request)
  {
    $size = 300;

    $user_id = $request->user_id ?? auth()->user()->id;

    $user = User::with('dinas', 'bidang', 'pegawai')->find($user_id);

    if ($request->with_logo) {
      $qrcodeLogo = QrCodeLogo::where('user_id', $user_id)->first();
      if (!$qrcodeLogo) {
        $request->session()->flash('error', 'Logo tidak ditemukan. Silahkan upload logo terlebih dahulu.');
        return response()->json(['status' => false]);
      }

      $path = base_path('public/storage/' . $qrcodeLogo->logo);

      $qrcode = QrCode::format('png')
        ->merge($path, 0.5, true)
        ->size($size)
        ->errorCorrection('H')
        ->generate(route('link.detail.pegawai', ['unique_code' => $user->unique_code]));
      
    } else {
      $qrcode = QrCode::format('png')->size($size)->generate(route('link.detail.pegawai', ['unique_code' => $user->unique_code]));
    }

    $tte = Tte::where('user_id', $user_id)->first();
    if ($tte && $tte->qrcode) {
      Storage::delete($tte->qrcode);
    }
    
    $output_filename = '/img/qr-code/img-' . time() . '.png';
    Storage::disk('public')->put($output_filename, $qrcode);

    Tte::updateOrCreate(
      ['user_id' => $user_id],
      ['qrcode' => $output_filename]
    );

    return response()->json([
      'html' => view('pic.generate-qrcode.generate-qrcode-result', compact('output_filename', 'user'))->render(),
    ]);
  }

  public function sendToMail(Request $request)
  {
    $image = $request->img;
    $image = str_replace('data:image/png;base64,', '', $image);
    $image = str_replace(' ', '+', $image);
    $data = base64_decode($image);

    $user_id = $request->user_id ?? auth()->user()->id;

    $tte = Tte::with('user')->where('user_id', $user_id)->first();
    if ($tte) {
      Storage::delete($tte->tte);
    }

    $destinationPath = '/img/qr-code/tte-'.time().'.jpg';
    Storage::disk('public')->put($destinationPath, $data);

    Tte::updateOrCreate(
      ['user_id' => $user_id],
      [
        'user_id' => $user_id,
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

    $user_id = $request->user_id ?? auth()->user()->id;

    $qrcodeLogo = QrCodeLogo::where('user_id', $user_id)->first();
    if ($qrcodeLogo) {

      Storage::delete($qrcodeLogo->logo);

      $qrcodeLogo->logo = $filename;
      $qrcodeLogo->save();
    } else {

      $qrcodeLogo = new QrCodeLogo();
      $qrcodeLogo->user_id = $user_id;
      $qrcodeLogo->logo = $filename;
      $qrcodeLogo->save();
    }

    $request->session()->flash('success', 'Logo berhasil diupload.');
    return response()->json(['status' => true]);
  }
}

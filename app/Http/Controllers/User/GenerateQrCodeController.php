<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateQrCodeRequest;
use App\Http\Requests\UploadLogoQrCodeRequest;
use App\Models\QrCodeLogo;
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
    $validated = $request->validated();

    if ($request->with_logo) {
      $qrcodeLogo = QrCodeLogo::where('user_id', auth()->user()->id)->first();
      if (!$qrcodeLogo) {
        $request->session()->flash('error', 'Logo tidak ditemukan. Silahkan upload logo terlebih dahulu.');
        return response()->json(['status' => false]);
      }

      $path = base_path('public/storage/' . $qrcodeLogo->logo);

      $qrcode = QrCode::format('png')
        ->merge($path, 0.5, true)
        ->size($validated['size'])
        ->errorCorrection('H')
        ->generate('http://google.com');
    } else {
      $qrcode = QrCode::format('png')->size($validated['size'])->generate('http://google.com');
    }

    return response(base64_encode($qrcode))->header('Content-Type', 'image/png');
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

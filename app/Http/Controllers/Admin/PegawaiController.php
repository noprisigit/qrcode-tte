<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateQrCodeRequest;
use App\Http\Requests\UploadLogoQrCodeRequest;
use App\Models\Document;
use App\Models\Pegawai;
use App\Models\QrCodeLogo;
use App\Models\TempUser;
use App\Models\Tte;
use App\Models\User;
use App\Models\VerifikasiPegawai;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
  public function index()
  {
    // $users = User::with('bidang', 'verifikasi_pegawai', 'pegawai')
    //   ->get();

    // $users = VerifikasiPegawai::groupBy('identity_number')->get();

    $users = TempUser::with('bidang', 'dinas')->get();
      
    return view('admin.pegawai.pegawai-index', compact('users'));
  }

  public function detail($id)
  {
    $pegawai = Pegawai::with('user')->where('user_id', $id)->first();

    $documents = Document::where('user_id', $id)->get();

    return view('admin.pegawai.pegawai-detail', compact('pegawai', 'documents'));
  }

  public function verification($id)
  {
    $pegawai = VerifikasiPegawai::with('user')->where('user_id', $id)->get();

    $documents = Document::where('user_id', $id)->get();

    return view('admin.pegawai.pegawai-verifikasi', compact('pegawai', 'documents'));
  }

  public function accept(Request $request)
  {
    $verifikasi_pegawai = VerifikasiPegawai::findOrFail($request->id);

    $verifikasi_pegawai->status = VerifikasiPegawai::STATUS_ACCEPTED;
    $verifikasi_pegawai->save();

    if (Schema::hasColumn('pegawai', $verifikasi_pegawai->name)) {
      Pegawai::updateOrCreate(
        ['user_id' => $verifikasi_pegawai->user_id],
        [
          $verifikasi_pegawai->name => $verifikasi_pegawai->value,
        ]
      );
    }

    if (Schema::hasColumn('users', $verifikasi_pegawai->name)) {
      User::updateOrCreate(
        ['id' => $verifikasi_pegawai->user_id],
        [
          $verifikasi_pegawai->name => $verifikasi_pegawai->value,
        ]
      );
    }
  }

  public function reject(Request $request)
  {
    $verifikasi_pegawai = VerifikasiPegawai::findOrFail($request->id);

    $verifikasi_pegawai->status = VerifikasiPegawai::STATUS_REJECTED;
    $verifikasi_pegawai->save();
  }

  public function generateTte($id)
  {
    $qrcodeLogo = QrCodeLogo::where('user_id', $id)->first();

    return view('admin.generate-qrcode.generate-qrcode-index', compact('qrcodeLogo', 'id'));
  }

  public function generateQrCode(GenerateQrCodeRequest $request)
  {
    $size = 300;

    $user = User::with('dinas', 'pegawai')->findOrFail($request->id);

    if ($request->with_logo) {
      $qrcodeLogo = QrCodeLogo::where('user_id', $request->id)->first();
      if (!$qrcodeLogo) {
        $request->session()->flash('error', 'Logo tidak ditemukan. Silahkan upload logo terlebih dahulu.');
        return response()->json(['status' => false]);
      }

      $path = base_path('public/storage/' . $qrcodeLogo->logo);

      $qrcode = QrCode::format('png')
        ->merge($path, 0.3, true)
        ->size($size)
        ->errorCorrection('H')
        ->generate(route('link.detail.pegawai', ['unique_code' => $user->unique_code]));
      
    } else {
      $qrcode = QrCode::format('png')->size($size)->generate(route('link.detail.pegawai', ['unique_code' => $user->unique_code]));
    }

    $tte = Tte::where('user_id', $request->id)->first();
    if ($tte && $tte->qrcode) {
      Storage::delete($tte->qrcode);
    }
    
    $output_filename = '/img/qr-code/img-' . time() . '.png';
    Storage::disk('public')->put($output_filename, $qrcode);

    Tte::updateOrCreate(
      ['user_id' => $request->id],
      ['qrcode' => $output_filename]
    );

    // return response(base64_encode($qrcode))->header('Content-Type', 'image/png');
    return response()->json([
      'html' => view('admin.generate-qrcode.generate-qrcode-result', compact('output_filename', 'user'))->render(),
    ]);
  }

  public function uploadLogo(UploadLogoQrCodeRequest $request, $id)
  {

    $uploadedLogo = $request->file('logo');
    $filename = $uploadedLogo->store('images/logo');

    $qrcodeLogo = QrCodeLogo::where('user_id', $id)->first();
    if ($qrcodeLogo) {

      Storage::delete($qrcodeLogo->logo);

      $qrcodeLogo->logo = $filename;
      $qrcodeLogo->save();
    } else {

      $qrcodeLogo = new QrCodeLogo();
      $qrcodeLogo->user_id = $id;
      $qrcodeLogo->logo = $filename;
      $qrcodeLogo->save();
    }

    $request->session()->flash('success', 'Logo berhasil diupload.');
    return response()->json(['status' => true]);
  }
}

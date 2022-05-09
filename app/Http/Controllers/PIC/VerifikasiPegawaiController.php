<?php

namespace App\Http\Controllers\PIC;

use App\Http\Controllers\Controller;
use App\Models\QrCodeLogo;
use App\Models\TempUser;
use App\Models\User;
use App\Models\VerifikasiPegawai;
use Illuminate\Http\Request;

class VerifikasiPegawaiController extends Controller
{
  public function index()
  {
    $users = TempUser::with('bidang', 'dinas')
      ->where('dinas_id', auth()->user()->dinas_id)
      ->get();

    return view('pic.verifikasi-pegawai.verifikasi-pegawai-index', compact('users'));
  }

  public function detail($id)
  {
    $user = TempUser::with('bidang', 'dinas')
      ->where('dinas_id', auth()->user()->dinas_id)
      ->findOrFail($id);

    $identity_number = $user->nik;
    $verify = VerifikasiPegawai::where('identity_number', $identity_number)->get();

    return view('pic.verifikasi-pegawai.verifikasi-pegawai-detail', compact('user', 'verify'));
  }

  public function generateTte($id)
  {
    $temp_user = TempUser::with('bidang', 'dinas')
      ->where('dinas_id', auth()->user()->dinas_id)
      ->findOrFail($id);

    $email = $temp_user->email;
    $user = User::with('bidang', 'dinas')
      ->where('email', $email)
      ->where('dinas_id', auth()->user()->dinas_id)
      ->firstOrFail();
    $user_id = $user->id;

    $qrcodeLogo = QrCodeLogo::where('user_id', $user_id)->first();

    return view('pic.verifikasi-pegawai.verifikasi-pegawai-qrcode', compact('qrcodeLogo', 'user_id'));
  }
}

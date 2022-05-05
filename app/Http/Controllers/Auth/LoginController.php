<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\VerifikasiPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
  public function login()
  {
    return view('auth.login');
  }

  public function doLogin(LoginRequest $request)
  {
    $validated = $request->validated();

    $email = $validated['email'];
    $verifikasi_pegawai = VerifikasiPegawai::where('value', $email)->first();
    if (!$verifikasi_pegawai) {
      $request->session()->flash('error', 'Email anda tidak terdaftar!');
      return redirect()->route('login');
    } else {
      if ($verifikasi_pegawai->status == VerifikasiPegawai::STATUS_WAITING) {
        $request->session()->flash('error', 'Data anda masih dalam tahap verifikasi!');
        return redirect()->route('login');
      } elseif ($verifikasi_pegawai->status == VerifikasiPegawai::STATUS_REJECTED) {
        $request->session()->flash('error', 'Data anda telah ditolak!. <br> Silahkan hubungi administrator untuk melakukan reset data anda!');
        return redirect()->route('login');
      }
    }

    $credentials = [
      'email' => $validated['email'],
      'password' => $validated['password'],
      'status' => User::STATUS_ACTIVE
    ];

    if (auth()->attempt($credentials)) {

      $request->session()->regenerate();

      if (auth()->user()->role_id == User::ROLE_ADMIN)
        return redirect()->route('admin.dashboard.index');

      if (auth()->user()->role_id == User::ROLE_PIC)
        return redirect()->route('pic.verification.index');
        
      if (auth()->user()->role_id == User::ROLE_USER)
        return redirect()->route('user.profile.index');
    }

    Session::flash('error', 'Email atau kata sandi salah!');
    return redirect()->route('login');
  }

  public function logout(Request $request)
  {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    Session::flash('success', 'Anda berhasil keluar!');
    return redirect()->route('login');
  }
}

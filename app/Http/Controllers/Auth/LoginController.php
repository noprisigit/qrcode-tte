<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
  public function index()
  {
    return view('auth.login');
  }

  public function authenticate(LoginRequest $request)
  {
    $validated = $request->validated();

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
        return redirect()->route('pic.dashboard.index');
        
      if (auth()->user()->role_id == User::ROLE_USER)
        return redirect()->route('user.profile.index');
    }

    Session::flash('error', 'Email atau kata sandi salah!');
    return redirect()->route('auth.login');
  }

  public function logout(Request $request)
  {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    Session::flash('success', 'Anda berhasil keluar!');
    return redirect()->route('auth.login');
  }
}

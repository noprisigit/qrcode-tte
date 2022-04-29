<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
  public function index()
  {
    return view('auth.register');
  }

  public function register(RegisterRequest $request)
  {
    $validated = $request->validated();

    $created = User::create([
      'nama' => $validated['name'],
      'unique_code' => HelperController::generateUniqueCode(),
      'email' => $validated['email'],
      'password' => Hash::make($validated['password']),
      'role_id' => User::ROLE_USER,
      'avatar' => 'default.png',
      'status' => User::STATUS_ACTIVE
    ]);

    if ($created) {
      Session::flash('success', 'Akun berhasil ditambahkan!');
    } else {
      Session::flash('error', 'Akun gagal ditambahkan!');
    }

    return redirect()->route('auth.login');
  }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\VerifikasiPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
  public function register()
  {
    return response()->view('auth.register');
  }

  public function doRegister(RegisterRequest $request)
  {
    $validated = $request->validated();

    $identity_number = $validated['nik'];

    $is_verification_data_exist = VerifikasiPegawai::where('identity_number', $identity_number)->exists();
    if ($is_verification_data_exist) {
      $request->session()->flash('error', 'Data anda sedang dalam proses verifikasi!');
      return redirect()->route('register');
    }

    $data = [
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'Nama Lengkap',
        'name' => 'nama',
        'value' => $validated['nama'],
        'status' => VerifikasiPegawai::STATUS_WAITING,
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'NIK',
        'name' => 'nik',
        'value' => $validated['nik'],
        'status' => VerifikasiPegawai::STATUS_WAITING,
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'NIP',
        'name' => 'nip',
        'value' => $validated['nip'],
        'status' => VerifikasiPegawai::STATUS_WAITING,
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'Email',
        'name' => 'email',
        'value' => $validated['email'],
        'status' => VerifikasiPegawai::STATUS_WAITING,
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'No Telpon',
        'name' => 'no_telp',
        'value' => $validated['no_telp'],
        'status' => VerifikasiPegawai::STATUS_WAITING
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'Tempat Lahir',
        'name' => 'tempat_lahir',
        'value' => $validated['tempat_lahir'],
        'status' => VerifikasiPegawai::STATUS_WAITING
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'date',
        'label' => 'Tanggal Lahir',
        'name' => 'tanggal_lahir',
        'value' => $validated['tanggal_lahir'],
        'status' => VerifikasiPegawai::STATUS_WAITING
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'Golongan',
        'name' => 'golongan',
        'value' => $validated['golongan'],
        'status' => VerifikasiPegawai::STATUS_WAITING
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'Pangkat',
        'name' => 'pangkat',
        'value' => $validated['pangkat'],
        'status' => VerifikasiPegawai::STATUS_WAITING
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'Password',
        'name' => 'password',
        'value' => $validated['password'],
        'status' => VerifikasiPegawai::STATUS_WAITING
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'Password Confirmation',
        'name' => 'password_confirmation',
        'value' => $validated['password_confirmation'],
        'status' => VerifikasiPegawai::STATUS_WAITING
      ]
    ];

    VerifikasiPegawai::insert($data);

    $request->session()->flash('success', 'Data anda telah berhasil didaftarkan. <br> Data anda akan kami verifikasi terlebih dahulu.');
    return redirect()->route('register');
  }
  // public function index()
  // {
  //   return view('auth.register');
  // }

  // public function register(RegisterRequest $request)
  // {
  //   $validated = $request->validated();

  //   $created = User::create([
  //     'nama' => $validated['name'],
  //     'unique_code' => HelperController::generateUniqueCode(),
  //     'email' => $validated['email'],
  //     'password' => Hash::make($validated['password']),
  //     'role_id' => User::ROLE_USER,
  //     'avatar' => 'default.png',
  //     'status' => User::STATUS_ACTIVE
  //   ]);

  //   if ($created) {
  //     Session::flash('success', 'Akun berhasil ditambahkan!');
  //   } else {
  //     Session::flash('error', 'Akun gagal ditambahkan!');
  //   }

  //   return redirect()->route('auth.login');
  // }
}

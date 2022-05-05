<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Http\Requests\RegisterRequest;
use App\Models\Dinas;
use App\Models\TempUser;
use App\Models\User;
use App\Models\VerifikasiPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
  public function register()
  {
    $dinas = Dinas::all();

    return response()->view('auth.register', compact('dinas'));
  }

  public function doRegister(RegisterRequest $request)
  {
    $validated = $request->validated();

    $identity_number = $validated['nik'];

    $is_verification_data_exist = VerifikasiPegawai::where('identity_number', $identity_number)
      ->where('status', VerifikasiPegawai::STATUS_WAITING)
      ->exists();
    if ($is_verification_data_exist) {
      $request->session()->flash('error', 'Data anda sedang dalam proses verifikasi!');
      return redirect()->route('register');
    }

    if ($request->hasFile('ktp')) {
      $file_ktp = $request->file('ktp');
      $ktp = $file_ktp->store('documents/ktp');
    }

    if ($request->hasFile('sk_terakhir')) {
      $file_sk_terakhir = $request->file('sk_terakhir');
      $sk_terakhir = $file_sk_terakhir->store('documents/sk_terakhir');
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
        'label' => 'Jenis Kelamin',
        'name' => 'jenis_kelamin',
        'value' => $validated['jenis_kelamin'],
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
        'label' => 'Dinas',
        'name' => 'dinas_id',
        'value' => $validated['dinas_id'],
        'status' => VerifikasiPegawai::STATUS_WAITING
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'Bidang',
        'name' => 'sub_bidang_id',
        'value' => $validated['sub_bidang_id'],
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
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'File KTP',
        'name' => 'file_ktp',
        'value' => $ktp,
        'status' => VerifikasiPegawai::STATUS_WAITING
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'File SK Terakhir',
        'name' => 'file_sk_terakhir',
        'value' => $sk_terakhir,
        'status' => VerifikasiPegawai::STATUS_WAITING
      ]
    ];

    TempUser::create([
      'nama' => $validated['nama'],
      'jenis_kelamin' => $validated['jenis_kelamin'],
      'email' => $validated['email'],
      'password' => $validated['password'],
      'dinas_id' => $validated['dinas_id'],
      'sub_bidang_id' => $validated['sub_bidang_id'],
      'unique_code' => HelperController::generateUniqueCode(),
      'nip' => $validated['nip'],
      'nik' => $validated['nik'],
      'no_telp' => $validated['no_telp'],
      'tempat_lahir' => $validated['tempat_lahir'],
      'tanggal_lahir' => $validated['tanggal_lahir'],
      'golongan' => $validated['golongan'],
      'pangkat' => $validated['pangkat'],
      'role_id' => User::ROLE_USER,
      'file_ktp' => $ktp,
      'file_sk_terakhir' => $sk_terakhir,
    ]);

    VerifikasiPegawai::insert($data);

    $request->session()->flash('success', 'Data anda telah berhasil didaftarkan. <br> Data anda akan kami verifikasi terlebih dahulu.');
    return redirect()->route('register');
  }
}

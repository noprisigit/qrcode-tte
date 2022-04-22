<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserUpdateProfileRequest;
use App\Models\Bidang;
use App\Models\Dinas;
use App\Models\User;
use App\Models\VerifikasiPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
  public function index()
  {
    return view('user.profile.profile-index');
  }

  public function edit()
  {
    $dinas = Dinas::all();

    $user = User::with('pegawai')->findOrFail(auth()->user()->id);

    $sub_bidang = $user->sub_bidang_id ? Bidang::where('dinas_id', $user->dinas_id)->get() : [];

    return view('user.profile.profile-edit', compact('dinas', 'user', 'sub_bidang'));
  }

  public function update(UserUpdateProfileRequest $request)
  {
    $validated = $request->validated();

    $isset_verifikasi = VerifikasiPegawai::where('user_id', auth()->user()->id)->exists();
    if ($isset_verifikasi) {
      Session::flash('error', 'Data anda belum diverifikasi, silahkan tunggu sampai verifikasi selesai');
      return redirect()->route('user.profile.index');
    }

    VerifikasiPegawai::create(['user_id' => auth()->user()->id, 'type' => 'string', 'label' => 'NIK', 'name' => 'nik', 'value' => $validated['nik'], 'status' => 0]);
    VerifikasiPegawai::create(['user_id' => auth()->user()->id, 'type' => 'string', 'label' => 'NIP', 'name' => 'nip', 'value' => $validated['nip'], 'status' => 0]);
    VerifikasiPegawai::create(['user_id' => auth()->user()->id, 'type' => 'string', 'label' => 'Nama', 'name' => 'nama', 'value' => $validated['name'], 'status' => 0]);
    VerifikasiPegawai::create(['user_id' => auth()->user()->id, 'type' => 'string', 'label' => 'Nomor Telepon', 'name' => 'no_telp', 'value' => $validated['phone'], 'status' => 0]);
    VerifikasiPegawai::create(['user_id' => auth()->user()->id, 'type' => 'string', 'label' => 'Jenis Kelamin', 'name' => 'jenis_kelamin', 'value' => $validated['gender'], 'status' => 0]);
    VerifikasiPegawai::create(['user_id' => auth()->user()->id, 'type' => 'integer', 'label' => 'Dinas', 'name' => 'dinas_id', 'value' => $validated['dinas_id'], 'status' => 0]);
    VerifikasiPegawai::create(['user_id' => auth()->user()->id, 'type' => 'integer', 'label' => 'Bidang', 'name' => 'sub_bidang_id', 'value' => $validated['sub_bidang_id'], 'status' => 0]);
    VerifikasiPegawai::create(['user_id' => auth()->user()->id, 'type' => 'string', 'label' => 'Tempat Lahir', 'name' => 'tempat_lahir', 'value' => $validated['pob'], 'status' => 0]);
    VerifikasiPegawai::create(['user_id' => auth()->user()->id, 'type' => 'date', 'label' => 'Tanggal Lahir', 'name' => 'tanggal_lahir', 'value' => $validated['dob'], 'status' => 0]);
    VerifikasiPegawai::create(['user_id' => auth()->user()->id, 'type' => 'string', 'label' => 'Pangkat', 'name' => 'pangkat', 'value' => $validated['pangkat'], 'status' => 0]);
    VerifikasiPegawai::create(['user_id' => auth()->user()->id, 'type' => 'date', 'label' => 'TMT Pangkat', 'name' => 'tmt_pangkat', 'value' => $validated['tmt_pangkat'], 'status' => 0]);
    VerifikasiPegawai::create(['user_id' => auth()->user()->id, 'type' => 'string', 'label' => 'Golongan', 'name' => 'golongan', 'value' => $validated['golongan'], 'status' => 0]);
    VerifikasiPegawai::create(['user_id' => auth()->user()->id, 'type' => 'date', 'label' => 'TMT Golongan', 'name' => 'tmt_golongan', 'value' => $validated['tmt_golongan'], 'status' => 0]);
    VerifikasiPegawai::create(['user_id' => auth()->user()->id, 'type' => 'date', 'label' => 'Tanggal Awal Pengangkatan', 'name' => 'tgl_awal_pengangkatan', 'value' => $validated['tgl_awal_pengangkatan'], 'status' => 0]);
    VerifikasiPegawai::create(['user_id' => auth()->user()->id, 'type' => 'string', 'label' => 'Status Kepegawaian', 'name' => 'status_kepegawaian', 'value' => $validated['status_kepegawaian'], 'status' => 0]);

    Session::flash('success', 'Data diri berhasil diperbarui, dan akan diverifikasi oleh admin atau PIC anda.');
    return redirect()->route('user.profile.index');
  }

  public function changePassword()
  {
    return view('user.profile.profile-change-password');
  }

  public function changePasswordProcess(UserChangePasswordRequest $request)
  {
    $validated = $request->validated();

    $user = auth()->user();
    if (!password_verify($validated['old_password'], $user->password)) {
      return redirect()->back()->with('error', 'Kata sandi lama tidak sesuai');
    }

    $user->password = Hash::make($validated['new_password']);
    $user->save();

    Session::flash('success', 'Kata sandi berhasil diubah');
    return redirect()->route('user.profile.index');
  }
}

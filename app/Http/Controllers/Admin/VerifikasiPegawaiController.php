<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailVerificationAcceptJob;
use App\Jobs\SendEmailVerificationRejectJob;
use App\Jobs\SendMailQrCodeJob;
use App\Models\Document;
use App\Models\Pegawai;
use App\Models\QrCodeLogo;
use App\Models\TempUser;
use App\Models\Tte;
use App\Models\User;
use App\Models\VerifikasiPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class VerifikasiPegawaiController extends Controller
{
  public function index() 
  {
    $users = TempUser::with('bidang', 'dinas')->get();

    return view('admin.verifikasi-pegawai.verifikasi-pegawai-index', compact('users'));
  }

  public function verify($id)
  {
    $user = TempUser::with('bidang', 'dinas')->findOrFail($id);

    $identity_number = $user->nik;
    $verify = VerifikasiPegawai::where('identity_number', $identity_number)->get();

    return view('admin.verifikasi-pegawai.verifikasi-pegawai-verify', compact('user', 'verify'));
  }

  public function accept($id)
  {
    $temp_user = TempUser::with('bidang', 'dinas')->findOrFail($id);

    $nama = $temp_user->nama;
    $nik = $temp_user->nik;
    $email = $temp_user->email;

    $user = User::insertGetId([
      'nama' => $temp_user->nama,
      'email' => $temp_user->email,
      'password' => Hash::make($temp_user->password),
      'unique_code' => $temp_user->unique_code,
      'no_telp' => $temp_user->no_telp,
      'dinas_id' => $temp_user->dinas_id,
      'sub_bidang_id' => $temp_user->sub_bidang_id,
      'role_id' => $temp_user->role_id,
      'avatar' => $temp_user->avatar,
      'status' => User::STATUS_ACTIVE,
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    Pegawai::create([
      'user_id' => $user,
      'jenis_kelamin' => $temp_user->jenis_kelamin,
      'tempat_lahir' => $temp_user->tempat_lahir,
      'tanggal_lahir' => $temp_user->tanggal_lahir,
      'nik' => $temp_user->nik,
      'nip' => $temp_user->nip,
      'pangkat' => $temp_user->pangkat,
      'tmt_pangkat' => $temp_user->tmt_pangkat,
      'golongan' => $temp_user->golongan,
      'tmt_golongan' => $temp_user->tmt_golongan,
      'tgl_awal_pengangkatan' => $temp_user->tgl_awal_pengangkatan,
      'status_kepegawaian' => $temp_user->status_kepegawaian,
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    $documents = [
      [
        'user_id' => $user,
        'jenis_dokumen' => 'KTP',
        'nama_file' => $temp_user->file_ktp,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'user_id' => $user,
        'jenis_dokumen' => 'SK Terakhir',
        'nama_file' => $temp_user->file_sk_terakhir,
        'created_at' => now(),
        'updated_at' => now(),
      ]
    ];
    Document::insert($documents);

    dispatch(new SendEmailVerificationAcceptJob($email));

    $verifikasi_pegawai = VerifikasiPegawai::where('identity_number', $nik)->get();
    foreach ($verifikasi_pegawai as $verifikasi) {
      $verifikasi->status = VerifikasiPegawai::STATUS_ACCEPTED;
      $verifikasi->save();
    }

    // $temp_user->delete();

    Session::flash('success', 'Data pegawai a.n ' . $nama . ' telah diterima.');
    return redirect()->route('admin.verifikasi-pegawai.index');
  }

  public function reject($id)
  {
    $temp_user = TempUser::with('bidang', 'dinas')->findOrFail($id);

    $nama = $temp_user->nama;
    $nik = $temp_user->nik;
    $email = $temp_user->email;

    dispatch(new SendEmailVerificationRejectJob($email));

    $verifikasi_pegawai = VerifikasiPegawai::where('identity_number', $nik)->get();
    foreach ($verifikasi_pegawai as $verifikasi) {
      $verifikasi->status = VerifikasiPegawai::STATUS_REJECTED;
      $verifikasi->save();
    }

    Session::flash('error', 'Data pegawai a.n ' . $nama . ' telah ditolak.');
    return redirect()->route('admin.verifikasi-pegawai.index');
  }

  public function reset($id)
  {
    $temp_user = TempUser::with('bidang', 'dinas')->findOrFail($id);

    $nik = $temp_user->nik;
    $nama = $temp_user->nama;
    $email = $temp_user->email;

    $pegawai = Pegawai::where('nik', $nik)->first();
    if ($pegawai) {
      $pegawai->delete();
    }

    $user = User::where('email', $email)->first();
    if ($user) {
      $user->delete();
    }

    $verifikasi_pegawai = VerifikasiPegawai::where('identity_number', $nik)->get();
    foreach ($verifikasi_pegawai as $verifikasi) {
      $verifikasi->delete();
    }

    $temp_user->delete();

    Session::flash('success', 'Data pegawai a.n ' . $nama . ' telah dihapus.');
    return redirect()->route('admin.verifikasi-pegawai.index');
  }

  public function detail($id)
  {
    $user = TempUser::with('bidang', 'dinas')->findOrFail($id);

    $identity_number = $user->nik;
    $verify = VerifikasiPegawai::where('identity_number', $identity_number)->get();

    return view('admin.verifikasi-pegawai.verifikasi-pegawai-detail', compact('user', 'verify'));
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

    return view('admin.verifikasi-pegawai.verifikasi-pegawai-qrcode', compact('user', 'qrcodeLogo', 'user_id'));
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
}

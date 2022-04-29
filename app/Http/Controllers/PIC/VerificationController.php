<?php

namespace App\Http\Controllers\PIC;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\VerifikasiPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class VerificationController extends Controller
{
  public function index()
  {
    $users = User::with('bidang', 'verifikasi_pegawai')
      ->where('dinas_id', auth()->user()->dinas_id)->get()
      ->where('role_id', User::ROLE_USER)
      ->except(auth()->user()->id);

    return view('pic.verification.verification-index', compact('users'));
  }

  public function edit($id)
  {
    $pegawai = VerifikasiPegawai::with('user')->where('user_id', $id)->whereHas('user', function ($query) {
      $query->where('dinas_id', auth()->user()->dinas_id);
    })->get();

    return view('pic.verification.verification-edit', compact('pegawai'));
  }

  public function detail($id)
  {
    $pegawai = Pegawai::with('user')->where('user_id', $id)->whereHas('user', function ($query) {
      $query->where('dinas_id', auth()->user()->dinas_id);
    })->first();

    $documents = Document::where('user_id', $id)->whereHas('user', function($query) {
      $query->where('dinas_id', auth()->user()->dinas_id);
    })->get();

    return view('pic.verification.verification-detail', compact('pegawai', 'documents'));
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

  public function profile()
  {
    $verifications = VerifikasiPegawai::where('user_id', auth()->user()->id)->get();

    return view('pic.verification.verification-profile', compact('verifications'));
  }

  public function reset(Request $request)
  {
    if ($request->id <> auth()->user()->id) {
      $request->session()->flash('error', 'Anda tidak memiliki akses!');
      return response()->json(['status' => false]);
    }

    VerifikasiPegawai::where('user_id', $request->id)->delete();

    $request->session()->flash('success', 'Verifikasi berhasil dihapus!');
    return response()->json(['status' => true]);
  }
}

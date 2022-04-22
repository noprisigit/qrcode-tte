<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\VerifikasiPegawai;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
  public function index()
  {
    $verifications = VerifikasiPegawai::where('user_id', auth()->user()->id)->get();

    return view('user.verification.verification-index', compact('verifications'));
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

<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class HelperController extends Controller
{
  public static function selectBidang(Request $request)
  {
    $dinas_id = $request->dinas_id;

    $options = Bidang::where('dinas_id', $dinas_id)->get();

    return view('components.select-bidang', compact('options'));
  }

  public static function showDetailPegawai($unique_code)
  { 
    $user = User::with('dinas', 'bidang', 'pegawai')->where('unique_code', $unique_code)->first();

    $pdf = PDF::loadView('pdf.detail-pegawai', compact('user'));
    return $pdf->download('TTE-'.$user->nama.'.pdf');
  }

  public static function generateUniqueCode()
  {

    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersNumber = strlen($characters);
    $codeLength = 6;

    $code = '';

    while (strlen($code) < 6) {
      $position = rand(0, $charactersNumber - 1);
      $character = $characters[$position];
      $code = $code . $character;
    }

    if (User::where('unique_code', $code)->exists()) {
      generateUniqueCode();
    }

    return $code;
  }
}

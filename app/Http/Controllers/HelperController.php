<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use Illuminate\Http\Request;

class HelperController extends Controller
{
  public function selectBidang(Request $request)
  {
    $dinas_id = $request->dinas_id;

    $options = Bidang::where('dinas_id', $dinas_id)->get();

    return view('components.select-bidang', compact('options'));
  }
}

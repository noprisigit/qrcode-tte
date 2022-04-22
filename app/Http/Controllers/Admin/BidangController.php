<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BidangRequest;
use App\Models\Bidang;
use App\Models\Dinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BidangController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $dinas = Dinas::orderBy('nama', 'asc')->get();
    $bidang = Bidang::with('dinas')->get();

    return view('admin.bidang.bidang-index', compact('bidang', 'dinas'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(BidangRequest $request)
  {
    $created = Bidang::create($request->validated());

    if ($created) {
      $request->session()->flash('success', 'Bidang berhasil ditambahkan!');
    } else {
      $request->session()->flash('error', 'Bidang gagal ditambahkan!');
    }

    return response()->json([
      'status' => true
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(BidangRequest $request, $id)
  {
    $bidang = Bidang::findOrFail($id);

    $updated = $bidang->update($request->validated());

    if ($updated) {
      $request->session()->flash('success', 'Bidang berhasil diperbarui!');
    } else {
      $request->session()->flash('error', 'Bidang gagal diperbarui!');
    }

    return response()->json([
      'status' => true,
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $bidang = Bidang::findOrFail($id);

    $deleted = $bidang->delete();

    if ($deleted) {
      Session::flash('success', 'Bidang berhasil dihapus!');
    } else {
      Session::flash('error', 'Bidang gagal dihapus!');
    }

    return redirect()->route('admin.bidang.index');
  }
}

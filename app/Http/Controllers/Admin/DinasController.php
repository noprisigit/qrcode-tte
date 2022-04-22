<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DinasRequest;
use App\Models\Dinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DinasController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $dinas = Dinas::all();

    return view('admin.dinas.dinas-index', compact('dinas'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(DinasRequest $request)
  {
    $created = Dinas::create($request->validated());

    if ($created) {
      $request->session()->flash('success', 'Dinas berhasil ditambahkan!');
    } else {
      $request->session()->flash('error', 'Dinas gagal ditambahkan!');
    }

    return response()->json([
      'status' => true
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(DinasRequest $request, $id)
  {
    $dinas = Dinas::findOrFail($id);

    $updated = $dinas->update($request->validated());

    if ($updated) {
      $request->session()->flash('success', 'Dinas berhasil diperbarui!');
    } else {
      $request->session()->flash('error', 'Dinas gagal diperbarui!');
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
    $dinas = Dinas::findOrFail($id);

    $deleted = $dinas->delete();

    if ($deleted) {
      Session::flash('success', 'Dinas berhasil dihapus!');
    } else {
      Session::flash('error', 'Dinas gagal dihapus!');
    }

    return redirect()->route('admin.dinas.index');
  }
}

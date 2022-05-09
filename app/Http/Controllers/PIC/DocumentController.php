<?php

namespace App\Http\Controllers\PIC;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
  public function index()
  {
    $documents = Document::where('user_id', auth()->user()->id)->get();

    return view('pic.document.document-index', compact('documents'));
  }

  public function store(DocumentRequest $request)
  {
    $validated = $request->validated();

    $file = $request->file('file');
    $filename = $file->store('documents');

    Document::updateOrCreate(
      [
        'user_id' => auth()->user()->id,
        'jenis_dokumen' => $validated['file_type']
      ],
      [
        'user_id' => auth()->user()->id,
        'jenis_dokumen' => $validated['file_type'],
        'nama_file' => $filename
      ]
    );

    $request->session()->flash('success', 'Dokumen berhasil ditambahkan!');
    return response()->json([
      'status' => true
    ]);
  }

  public function destroy($id)
  {
    $document = Document::where('user_id', auth()->user()->id)->where('id', $id)->firstOrFail();
    Storage::delete($document->nama_file);
    $document->delete();

    Session::flash('success', 'Dokumen berhasil dihapus!');
    return redirect()->back();
  }
}

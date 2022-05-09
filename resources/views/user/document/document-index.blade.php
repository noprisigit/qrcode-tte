@extends('main')

@section('title', 'Berkas Saya')

@section('content')
<section class="section">

  @if (Session::has('success'))
  <div class="alert alert-success notification">{{ Session::get('success') }}</div>
  @endif

  @if (Session::has('error'))
  <div class="alert alert-danger notification">{{ Session::get('error') }}</div>
  @endif

  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold text-primary">Berkas Pribadi</h6>
      <div>
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#uploadDocumentModal"><i class="fas fa-key me-2"></i> {{ __('Unggah Berkas') }}</a>
      </div>
    </div>
  
    <div class="card-body">
      @if (count($documents) < 1)
        <div class="alert alert-danger text-center">
          {{ __('Anda belum mengunggah berkas apapun') }}
        </div>
      @else
        <table class="table text-dark">
          <thead>
            <tr>
              <th>{{ __('Nama') }}</th>
              <th>{{ __('Tanggal Unggah') }}</th>
              <th>{{ __('Aksi') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($documents as $document)
              <tr>
                <td>{{ $document->jenis_dokumen }}</td>
                <td>{{ $document->created_at->format('d M Y') }}</td>
                <td>
                  <a href="{{ asset('storage/' . $document->nama_file ) }}" class="btn btn-primary"><i class="fas fa-download me-2"></i> {{ __('Unduh') }}</a>
                  <a href="{{ route('user.documents.destroy', $document->id) }}" class="btn btn-danger" onclick="confirm('File akan dihapus!')"><i class="fas fa-trash me-2"></i> {{ __('Hapus') }}</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>
  </div>
</section>

<div class="modal fade text-left modal-borderless" id="uploadDocumentModal" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Unggah Berkas</h5>
        <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <form action="{{ route('user.documents.store') }}" method="POST" id="form-upload-document">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="file_type">{{ __('Jenis File') }}</label>
            <select name="file_type" id="file_type" class="form-control">
              <option selected disabled>Pilih Jenis File</option>
              <option value="KTP">KTP</option>
              <option value="SK Terakhir">SK Terakhir</option>
            </select>
            <span class="invalid-feedback" id="file_type"></span>
          </div>
          <div class="form-group">
            <label for="file_type">{{ __('File') }}</label>
            <input type="file" name="file" id="file" class="form-control" placeholder="Jenis File ex. KTP, SK Terakhir">
            <span class="invalid-feedback" id="file"></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light-primary" data-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Batal</span>
          </button>
          <button type="submit" class="btn btn-primary ml-1">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Unggah</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#form-upload-document').on('submit', function(e) {
      e.preventDefault();

      $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: new FormData(this),
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function() {
          before_submit('#form-upload-document');
        },
        success: function(data) {
          if (data.status === true) {
            $('#uploadDocumentModal').modal('toggle');
            $('#form-upload-document')[0].reset();
            window.location.reload();
          }
        },
        error: function(err) {
          error_submit(err);
        },
        complete: function() {
          complete_submit('#form-upload-document', 'Simpan');
        }
      });
    });
  });
</script>
@endpush
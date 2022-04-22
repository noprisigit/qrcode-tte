@extends('main')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendors/jquery-datatables/jquery.dataTables.bootstrap5.min.css') }}">
@endsection

@section('content')
<section class="section">
  <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalAdd">
    <i class="fas fa-plus me-2"></i>
    {{ __('Tambah') }}
  </button>

  <div class="modal modal-borderless fade text-left" id="modalAdd" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <form action="{{ route('admin.dinas.store') }}" method="post" id="form-create">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel1">{{ __('Form Tambah Dinas') }}</h5>
            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
              <i data-feather="x"></i>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="nama">{{ __('Nama Dinas') }}</label>
                  <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama Dinas">
                  <span class="invalid-feedback" id="nama"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">{{ __('Tutup') }}</span>
            </button>
            <button type="submit" class="btn btn-primary ml-1">
              <i class="bx bx-check d-block d-sm-none"></i>
              <span class="d-none d-sm-block">{{ __('Simpan') }}</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  @if (Session::has('success'))
    <div class="alert alert-success notification">{{ Session::get('success') }}</div>
  @endif
  
  @if (Session::has('error'))
    <div class="alert alert-danger notification">{{ Session::get('error') }}</div>
  @endif

  <div class="card">
    <div class="card-header">
      <h4 class="card-title">{{ __('Data Dinas') }}</h4>
    </div>
    <div class="card-body">
      <table class="table" id="data-table">
        <thead>
          <tr>
            <th>{{ __('#') }}</th>
            <th>{{ __('Nama') }}</th>
            <th>{{ __('Dibuat pada') }}</th>
            <th>{{ __('Aksi') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($dinas as $k => $item)
            <tr>
              <td>{{ ++$k }}</td>
              <td>{{ $item->nama }}</td>
              <td>{{ \Carbon\Carbon::create($item->created_at)->diffForHumans() }}</td>
              <td>
                <button type="button" class="btn btn-warning btn-sm btn-edit me-1" data-bs-toggle="modal" data-action="{{ route('admin.dinas.update', $item->id) }}" data-nama="{{ $item->nama }}" data-bs-target="#modalEdit">
                  <i class="fas fa-pencil-alt me-2"></i>
                  {{ __('Edit') }}
                </a>
                <button type="button" class="btn btn-danger btn-sm btn-delete" data-action="{{ route('admin.dinas.destroy', $item->id) }}" data-bs-toggle="modal" data-bs-target="#modalDelete">
                  <i class="fas fa-trash-alt me-2"></i>
                  {{ __('Hapus') }}
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>

<div class="modal modal-borderless fade text-left" id="modalEdit" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post" id="form-edit">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel1">{{ __('Form Edit Dinas') }}</h5>
          <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="nama">{{ __('Nama Dinas') }}</label>
                <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama Dinas">
                <span class="invalid-feedback" id="nama"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">{{ __('Tutup') }}</span>
          </button>
          <button type="submit" class="btn btn-primary ml-1">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">{{ __('Perbarui') }}</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal modal-borderless fade text-left" id="modalEdit" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post" id="form-edit">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel1">{{ __('Form Edit Dinas') }}</h5>
          <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="nama">{{ __('Nama Dinas') }}</label>
                <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama Dinas">
                <span class="invalid-feedback" id="nama"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">{{ __('Tutup') }}</span>
          </button>
          <button type="submit" class="btn btn-primary ml-1">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">{{ __('Perbarui') }}</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal modal-borderless fade text-left" id="modalDelete" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post" id="form-delete">
        @csrf
        @method('DELETE')
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel1">{{ __('Apakah kamu yakin?') }}</h5>
          <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <div class="modal-body">
         
          <p class="mb-0">
              <div class="d-flex align-items-center">
              <i class="fas fa-question-circle fa-2x text-danger me-2"></i> 
              {{ __('Data yang sudah dihapus tidak dapat dikembalikan lagi.') }}
            </div>
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">{{ __('Batal') }}</span>
          </button>
          <button type="submit" class="btn btn-danger ml-1">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">{{ __('Hapus') }}</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery-datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#data-table').DataTable();

    $('#form-create').on('submit', function(e) {
      e.preventDefault();

      $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: new FormData(this),
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function() {
          before_submit('#form-create');
        },
        success: function(data) {
          if (data.status === true) {
            $('#modalAdd').modal('toggle');
            $('#form-create')[0].reset();
            window.location.reload();
          }
        },
        error: function(err) {
          error_submit(err);
        },
        complete: function() {
          complete_submit('#form-create', 'Simpan');
        }
      });
    });

    $('.btn-edit').on('click', function(e) {
      e.preventDefault();

      $('#form-edit').attr('action', $(this).attr('data-action'));
      $('#form-edit #nama').val($(this).attr('data-nama'));
    });

    $('#form-edit').on('submit', function(e) {
      e.preventDefault();

      $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: new FormData(this),
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function() {
          before_submit('#form-edit');
        },
        success: function(data) {
          if (data.status === true) {
            $('#modalEdit').modal('toggle');
            $('#form-edit')[0].reset();
            window.location.reload();
          }
        },
        error: function(err) {
          error_submit(err);
        },
        complete: function() {
          complete_submit('#form-edit', 'Perbarui');
        }
      });
    });

    $('.btn-delete').on('click', function(e) {
      e.preventDefault();

      $('#form-delete').attr('action', $(this).attr('data-action'));
    });
  });
</script>
@endpush
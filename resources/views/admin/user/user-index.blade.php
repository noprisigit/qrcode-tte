@extends('main')

@section('title', 'Pengguna')

@section('css')
<link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="section">
  <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-2">
    <i class="fas fa-plus me-2"></i>
    {{ __('Tambah') }}
  </a>

  @if (Session::has('success'))
    <div class="alert alert-success notification">{{ Session::get('success') }}</div>
  @endif
  
  @if (Session::has('error'))
    <div class="alert alert-danger notification">{{ Session::get('error') }}</div>
  @endif

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Daftar Dinas</h6>
    </div>
    <div class="card-body">
      <table class="table table-bordered" id="data-table">
        <thead>
          <tr>
            <th>{{ __('#') }}</th>
            <th>{{ __('Nama') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Telp') }}</th>
            <th>{{ __('Dinas') }}</th>
            <th>{{ __('Hak Akses') }}</th>
            <th>{{ __('Status Akun') }}</th>
            <th>{{ __('Aksi') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $k => $item)
            <tr>
              <td>{{ ++$k }}</td>
              <td>{{ $item->nama }}</td>
              <td>{{ $item->email }}</td>
              <td>{{ $item->no_telp }}</td>
              <td>
                @if ($item->dinas)
                  {{ $item->dinas->nama }}
                @endif
              </td>
              <td>{!! \App\Models\User::getRoleName(strval($item->role_id), true) !!}</td>
              <td>{!! \App\Models\User::getStatus(strval($item->status), true) !!}</td>
              <td>
                <a href="{{ route('admin.user.show', ['id' => $item->id]) }}" class="btn btn-dark btn-sm me-1" >
                  <i class="fas fa-eye me-2"></i>
                  {{ __('Lihat') }}
                </a>
                <a href="{{ route('admin.user.edit', ['id' => $item->id]) }}" class="btn btn-warning btn-sm me-1" >
                  <i class="fas fa-pencil-alt me-2"></i>
                  {{ __('Edit') }}
                </a>
                <a href="{{ route('admin.user.destroy', ['id' => $item->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Data ini akan dihapus?')">
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
          <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
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
          <button type="button" class="btn btn-light-primary" data-dismiss="modal">
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
          <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
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
          <button type="button" class="btn btn-light-primary" data-dismiss="modal">
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
          <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
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
          <button type="button" class="btn btn-light-danger" data-dismiss="modal">
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
<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
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
@extends('main')

@section('title', 'Verifikasi Data Pegawai')

@section('css')
<link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="section">

  @if (Session::has('success'))
  <div class="alert alert-success notification">{{ Session::get('success') }}</div>
  @endif

  @if (Session::has('error'))
  <div class="alert alert-danger notification">{{ Session::get('error') }}</div>
  @endif

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Verifikasi Data Pegawai</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="data-table" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ __('#') }}</th>
              <th>{{ __('Nama') }}</th>
              <th>{{ __('Email') }}</th>
              <th>{{ __('No Telepon') }}</th>
              <th>{{ __('Dinas') }}</th>
              <th>{{ __('Bidang') }}</th>
              <th>{{ __('Status Verifikasi') }}</th>
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
                  @if ($item->dinas_id)
                  {{ $item->dinas->nama }}
                  @endif
                </td>
                <td>
                  @if ($item->sub_bidang_id)
                    {{ $item->bidang->nama }}
                  @endif
                </td>

                <td>
                  @php
                    $verifikasi_pegawai = \App\Models\VerifikasiPegawai::where('identity_number', $item->nik)->first();
                  @endphp

                  @if ($verifikasi_pegawai)
                    @if ($verifikasi_pegawai->status == \App\Models\VerifikasiPegawai::STATUS_WAITING)
                      <span class="badge badge-dark">Menunggu</span>
                    @elseif ($verifikasi_pegawai->status == \App\Models\VerifikasiPegawai::STATUS_ACCEPTED)
                      <span class="badge badge-success">Diterima</span>
                    @elseif ($verifikasi_pegawai->status == \App\Models\VerifikasiPegawai::STATUS_REJECTED)
                      <span class="badge badge-danger">Ditolak</span>
                    @endif
                  @endif
                </td>

                <td>
                  
                  @if ($verifikasi_pegawai)
                    @if ($verifikasi_pegawai->status == \App\Models\VerifikasiPegawai::STATUS_WAITING)
                      <a href="{{ route('admin.verifikasi-pegawai.verify', ['id' => $item->id]) }}" class="btn btn-dark btn-sm me-1">
                        <i class="fas fa-user-check me-2"></i>
                        {{ __('Verifikasi') }}
                      </a>
                    @elseif ($verifikasi_pegawai->status == \App\Models\VerifikasiPegawai::STATUS_ACCEPTED)
                      <a href="{{ route('admin.verifikasi-pegawai.detail', ['id' => $item->id]) }}" class="btn btn-primary btn-sm me-1">
                        <i class="fas fa-eye me-2"></i>
                        {{ __('Lihat') }}
                      </a>
                    @elseif ($verifikasi_pegawai->status == \App\Models\VerifikasiPegawai::STATUS_REJECTED)
                      <a href="{{ route('admin.verifikasi-pegawai.reset', ['id' => $item->id]) }}" onclick="return confirm('Data ini akan dihapus?')" class="btn btn-danger btn-sm btn-block">
                        <i class="fas fa-trash-alt mr-1"></i>
                        {{ __('Reset Data') }}
                      </a>
                    @endif
                  @endif

                </td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

@endsection

@push('js')
<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#data-table').DataTable();
  });
</script>
@endpush
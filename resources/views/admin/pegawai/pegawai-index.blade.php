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
                  {{-- @if (count($arr) > 0)
                  <a href="{{ route('admin.pegawai.verification', ['id' => $item->id]) }}"
                    class="btn btn-secondary btn-sm"><i class="fas fa-check"></i> {{ __('Verifikasi') }}</a>
                  @endif --}}
                  <a href="{{ route('admin.pegawai.detail', ['id' => $item->id]) }}" class="btn btn-dark btn-sm me-1">
                    <i class="fas fa-eye me-2"></i>
                    {{ __('Detail') }}
                  </a>

                  {{-- @if ($item->pegawai)
                  <a href="{{ route('admin.pegawai.tte', ['id' => $item->id]) }}" class="btn btn-primary btn-sm me-1">
                    <i class="fas fa-qrcode me-2"></i>
                    {{ __('Cetak TTE') }}
                  </a>
                  @endif --}}
                  {{-- <button type="button" class="btn btn-danger btn-sm btn-delete"
                    data-action="{{ route('admin', $item->id) }}" data-bs-toggle="modal"
                    data-bs-target="#modalDelete">
                    <i class="fas fa-trash-alt me-2"></i>
                    {{ __('Hapus') }}
                  </button> --}}
                </td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  {{-- <div class="card">
    <div class="card-header">
      <h4 class="card-title">{{ __('Data Pegawai') }}</h4>
    </div>
    <div class="card-body">
      <table class="table" id="data-table">
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
              @if ($item->verifikasi_pegawai)

              @php
              $arr = [];
              @endphp
              @foreach ($item->verifikasi_pegawai as $verifikasi_pegawai)
              @if ($verifikasi_pegawai->status == \App\Models\VerifikasiPegawai::STATUS_WAITING)
              @php
              array_push($arr, $verifikasi_pegawai->status);
              @endphp
              @endif
              @endforeach

              @if (count($arr) > 0)
              <span class="badge bg-secondary">{{ __('Menunggu Verifikasi') }}</span>
              @endif
              @endif
            </td>
            <td>
              @if (count($arr) > 0)
              <a href="{{ route('admin.pegawai.verification', ['id' => $item->id]) }}"
                class="btn btn-secondary btn-sm"><i class="fas fa-check"></i> {{ __('Verifikasi') }}</a>
              @endif
              <a href="{{ route('admin.pegawai.detail', ['id' => $item->id]) }}" class="btn btn-dark btn-sm me-1">
                <i class="fas fa-eye me-2"></i>
                {{ __('Detail') }}
              </a>

              @if ($item->pegawai)
              <a href="{{ route('admin.pegawai.tte', ['id' => $item->id]) }}" class="btn btn-primary btn-sm me-1">
                <i class="fas fa-qrcode me-2"></i>
                {{ __('Cetak TTE') }}
              </a>
              @endif
              <button type="button" class="btn btn-danger btn-sm btn-delete"
                data-action="{{ route('admin.bidang.destroy', $item->id) }}" data-bs-toggle="modal"
                data-bs-target="#modalDelete">
                <i class="fas fa-trash-alt me-2"></i>
                {{ __('Hapus') }}
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div> --}}
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
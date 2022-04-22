@extends('main')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendors/jquery-datatables/jquery.dataTables.bootstrap5.min.css') }}">
@endsection

@section('content')
<section class="section">

  @if (Session::has('success'))
    <div class="alert alert-success notification">{{ Session::get('success') }}</div>
  @endif
  
  @if (Session::has('error'))
    <div class="alert alert-danger notification">{{ Session::get('error') }}</div>
  @endif

  <div class="card">
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
                  <a href="{{ route('pic.verification.edit', ['id' => $item->id]) }}" class="btn btn-secondary btn-sm"><i class="fas fa-check"></i> {{ __('Verifikasi') }}</a>
                @endif
                <a href="{{ route('pic.verification.detail', ['id' => $item->id]) }}" class="btn btn-dark btn-sm me-1">
                  <i class="fas fa-eye me-2"></i>
                  {{ __('Detail') }}
                </a>
                <button type="button" class="btn btn-danger btn-sm btn-delete" data-action="{{ route('admin.bidang.destroy', $item->id) }}" data-bs-toggle="modal" data-bs-target="#modalDelete">
                  <i class="fas fa-trash-alt me-2"></i>
                  {{ __('Hapus') }}
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>

@endsection

@push('js')
<script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery-datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#data-table').DataTable();
  });
</script>
@endpush
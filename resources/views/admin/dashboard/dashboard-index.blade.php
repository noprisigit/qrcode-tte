@extends('main')

@section('title', 'Dashboard')

@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Selamat Datang</h6>
  </div>
  <div class="card-body">
    <p>Selamat datang pada sistem informasi pencetakan tanda tangan elektronik Provinsi Kepulauan Bangka Belitung.</p>
  </div>
</div>
{{--
<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
              Pegawai</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_pegawai }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Pengguna</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_user }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Pending Requests Card Example -->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
              Tanda Tangan Elektronik</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_tte }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-qrcode fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> --}}
@endsection
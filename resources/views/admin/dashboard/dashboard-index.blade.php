@extends('main')

@section('title', 'Dashboard')

@section('content')
<div class="row">
  <div class="col-6 col-lg-4 col-md-6">
    <div class="card">
      <div class="card-body px-3 py-4-5">
        <div class="row">
          <div class="col-md-4">
            <div class="stats-icon purple">
              <i class="fas fa-person text-white"></i>
            </div>
          </div>
          <div class="col-md-8">
            <h6 class="text-muted font-semibold">Pegawai</h6>
            <h6 class="font-extrabold mb-0">{{ $total_pegawai }}</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-4 col-md-6">
    <div class="card">
      <div class="card-body px-3 py-4-5">
        <div class="row">
          <div class="col-md-4">
            <div class="stats-icon blue">
              <i class="fas fa-user-plus text-white"></i>
            </div>
          </div>
          <div class="col-md-8">
            <h6 class="text-muted font-semibold">Pengguna</h6>
            <h6 class="font-extrabold mb-0">{{ $total_user }}</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-4 col-md-6">
    <div class="card">
      <div class="card-body px-3 py-4-5">
        <div class="row">
          <div class="col-md-4">
            <div class="stats-icon green">
              <i class="fas fa-qrcode text-white"></i>
            </div>
          </div>
          <div class="col-md-8">
            <h6 class="text-muted font-semibold">Tanda Tangan Digital</h6>
            <h6 class="font-extrabold mb-0">{{ $total_tte }}</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
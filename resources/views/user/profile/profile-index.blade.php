@extends('main')

@section('title', 'Profil Saya')

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
      <h6 class="m-0 font-weight-bold text-primary">Data Diri</h6>
      <div>
        <a href="{{ route('user.profile.change-password') }}" class="btn btn-secondary"><i class="fas fa-key me-2"></i> {{ __('Ubah Kata Sandi') }}</a>
        <a href="{{ route('user.profile.edit') }}" class="btn btn-primary"><i class="fas fa-user me-2"></i> {{ __('Ubah Data Diri') }}</a>
      </div>
    </div>
    
    <div class="card-body">
      <table >
        <tbody>
          <tr>
            <th class="border-bottom-0" width="25%">{{ __('Nama') }}</th>
            <th class="border-bottom-0" width="1%">:</th>
            <td class="border-bottom-0">{{ auth()->user()->nama }}</td>
          </tr>
          <tr>
            <th class="border-bottom-0" width="25%">{{ __('NIK') }}</th>
            <th class="border-bottom-0" width="1%">:</th>
            <td class="border-bottom-0">
              @if (auth()->user()->pegawai)
                  {{ auth()->user()->pegawai->nik }}
              @endif
            </td>
          </tr>
          <tr>
            <th class="border-bottom-0" width="25%">{{ __('NIP') }}</th>
            <th class="border-bottom-0" width="1%">:</th>
            <td class="border-bottom-0">
              @if (auth()->user()->pegawai)
                  {{ auth()->user()->pegawai->nip }}
              @endif
            </td>
          </tr>
          <tr>
            <th class="border-bottom-0" width="25%">{{ __('Email') }}</th>
            <th class="border-bottom-0" width="1%">:</th>
            <td class="border-bottom-0">{{ auth()->user()->email }}</td>
          </tr>
          <tr>
            <th class="border-bottom-0" width="25%">{{ __('No Telepon') }}</th>
            <th class="border-bottom-0" width="1%">:</th>
            <td class="border-bottom-0">{{ auth()->user()->no_telp }}</td>
          </tr>
          <tr>
            <th class="border-bottom-0" width="25%">{{ __('Dinas') }}</th>
            <th class="border-bottom-0" width="1%">:</th>
            <td class="border-bottom-0">@if(auth()->user()->dinas) {{ auth()->user()->dinas->nama }} @endif</td>
          </tr>
          <tr>
            <th class="border-bottom-0" width="25%">{{ __('Sub Bidang') }}</th>
            <th class="border-bottom-0" width="1%">:</th>
            <td class="border-bottom-0">@if(auth()->user()->bidang) {{ auth()->user()->bidang->nama }} @endif</td>
          </tr>
          <tr>
            <th class="border-bottom-0" width="25%">{{ __('Tempat Lahir') }}</th>
            <th class="border-bottom-0" width="1%">:</th>
            <td class="border-bottom-0">@if(auth()->user()->pegawai) {{ auth()->user()->pegawai->tempat_lahir }} @endif</td>
          </tr>
          <tr>
            <th class="border-bottom-0" width="25%">{{ __('Tanggal Lahir') }}</th>
            <th class="border-bottom-0" width="1%">:</th>
            <td class="border-bottom-0">@if(auth()->user()->pegawai) {{ \App\Models\Pegawai::getTanggalIndonesia(auth()->user()->pegawai->tanggal_lahir, true) }} @endif</td>
          </tr>
          <tr>
            <th class="border-bottom-0" width="25%">{{ __('Jenis Kelamin') }}</th>
            <th class="border-bottom-0" width="1%">:</th>
            <td class="border-bottom-0">
              @if (auth()->user()->pegawai)
                  {{ auth()->user()->pegawai->jenis_kelamin }}
              @endif
            </td>
          </tr>
          <tr>
            <th class="border-bottom-0" width="25%">{{ __('Pangkat') }}</th>
            <th class="border-bottom-0" width="1%">:</th>
            <td class="border-bottom-0">@if(auth()->user()->pegawai) {{ auth()->user()->pegawai->pangkat }} @endif</td>
          </tr>
          <tr>
            <th class="border-bottom-0" width="25%">{{ __('Golongan') }}</th>
            <th class="border-bottom-0" width="1%">:</th>
            <td class="border-bottom-0">@if(auth()->user()->pegawai) {{ auth()->user()->pegawai->golongan }} @endif</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

@endsection
@extends('main')

@section('content')
<section class="section">

  @if (Session::has('success'))
    <div class="alert alert-success notification">{{ Session::get('success') }}</div>
  @endif
  
  @if (Session::has('error'))
    <div class="alert alert-danger notification">{{ Session::get('error') }}</div>
  @endif

  @if (!$pegawai) 
    <div class="alert alert-danger">{{ __('Data tidak ditemukan') }}</div>
  @else
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <h4 class="card-title">{{ __('Data Pegawai') }}</h4>
        </div>

      </div>
      <div class="card-body">
        <table class="table text-dark">
          <tbody>
            <tr>
              <th class="border-bottom-0" width="15%">{{ __('NIK') }}</th>
              <th class="border-bottom-0" width="1%">{{ __(':') }}</th>
              <td class="border-bottom-0">{{ $pegawai->nik }}</td>
            </tr>
            <tr>
              <th class="border-bottom-0" width="15%">{{ __('NIP') }}</th>
              <th class="border-bottom-0" width="1%">{{ __(':') }}</th>
              <td class="border-bottom-0">{{ $pegawai->nip }}</td>
            </tr>
            <tr>
              <th class="border-bottom-0" width="15%">{{ __('Nama Lengkap') }}</th>
              <th class="border-bottom-0" width="1%">{{ __(':') }}</th>
              <td class="border-bottom-0">{{ $pegawai->user->nama }}</td>
            </tr>
            <tr>
              <th class="border-bottom-0" width="15%">{{ __('Nomor Telepon') }}</th>
              <th class="border-bottom-0" width="1%">{{ __(':') }}</th>
              <td class="border-bottom-0">{{ $pegawai->user->no_telp }}</td>
            </tr>
            <tr>
              <th class="border-bottom-0" width="15%">{{ __('Jenis Kelamin') }}</th>
              <th class="border-bottom-0" width="1%">{{ __(':') }}</th>
              <td class="border-bottom-0">{{ $pegawai->jenis_kelamin }}</td>
            </tr>
            <tr>
              <th class="border-bottom-0" width="15%">{{ __('Dinas') }}</th>
              <th class="border-bottom-0" width="1%">{{ __(':') }}</th>
              <td class="border-bottom-0">@if ($pegawai->user->dinas_id) {{ $pegawai->user->dinas->nama }} @endif</td>
            </tr>
            <tr>
              <th class="border-bottom-0" width="15%">{{ __('Bidang') }}</th>
              <th class="border-bottom-0" width="1%">{{ __(':') }}</th>
              <td class="border-bottom-0">@if ($pegawai->user->sub_bidang_id) {{ $pegawai->user->bidang->nama }} @endif</td>
            </tr>
            <tr>
              <th class="border-bottom-0" width="15%">{{ __('Tempat Lahir') }}</th>
              <th class="border-bottom-0" width="1%">{{ __(':') }}</th>
              <td class="border-bottom-0">{{ $pegawai->tempat_lahir }}</td>
            </tr>
            <tr>
              <th class="border-bottom-0" width="15%">{{ __('Tanggal Lahir') }}</th>
              <th class="border-bottom-0" width="1%">{{ __(':') }}</th>
              <td class="border-bottom-0">{{ \Carbon\Carbon::create($pegawai->tanggal_lahir)->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
              <th class="border-bottom-0" width="15%">{{ __('Pangkat') }}</th>
              <th class="border-bottom-0" width="1%">{{ __(':') }}</th>
              <td class="border-bottom-0">{{ $pegawai->pangkat }}</td>
            </tr>
            <tr>
              <th class="border-bottom-0" width="15%">{{ __('TMT Pangkat') }}</th>
              <th class="border-bottom-0" width="1%">{{ __(':') }}</th>
              <td class="border-bottom-0">{{ \Carbon\Carbon::create($pegawai->tmt_pangkat)->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
              <th class="border-bottom-0" width="15%">{{ __('Golongan') }}</th>
              <th class="border-bottom-0" width="1%">{{ __(':') }}</th>
              <td class="border-bottom-0">{{ $pegawai->golongan }}</td>
            </tr>
            <tr>
              <th class="border-bottom-0" width="15%">{{ __('TMT Golongan') }}</th>
              <th class="border-bottom-0" width="1%">{{ __(':') }}</th>
              <td class="border-bottom-0">{{ \Carbon\Carbon::create($pegawai->tmt_golongan)->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
              <th class="border-bottom-0" width="15%">{{ __('Tanggal Awal Pengangkatan') }}</th>
              <th class="border-bottom-0" width="1%">{{ __(':') }}</th>
              <td class="border-bottom-0">{{ \Carbon\Carbon::create($pegawai->tgl_awal_pengangkatan)->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
              <th class="border-bottom-0" width="15%">{{ __('Status Kepegawaian') }}</th>
              <th class="border-bottom-0" width="1%">{{ __(':') }}</th>
              <td class="border-bottom-0">{{ $pegawai->status_kepegawaian }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  @endif

</section>
@endsection
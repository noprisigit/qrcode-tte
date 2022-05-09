@extends('main')

@section('title', 'Ubah Profil Saya')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-12 col-md-12 col-lg-12">

      @if (Session::has('success'))
        <div class="alert alert-success notification">{{ Session::get('success') }}</div>
      @endif
      
      @if (Session::has('error'))
        <div class="alert alert-danger notification">{{ Session::get('error') }}</div>
      @endif

      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Form Ubah Data Diri</h6>
        </div>
        <div class="card-body">
          <form action="{{ route('user.profile.update') }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="nik">{{ __('NIK') }} <span class="text-danger">*</span></label>
                  <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik', $user->pegawai && $user->pegawai->nik ? $user->pegawai->nik : '') }}" placeholder="NIK">
                  @error('nik')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="nip">{{ __('NIP') }} <span class="text-danger">*</span></label>
                  <input type="text" name="nip" id="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip', $user->pegawai && $user->pegawai->nip ? $user->pegawai->nip : '') }}" placeholder="NIP">
                  @error('nip')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="name">{{ __('Nama') }} <span class="text-danger">*</span></label>
                  <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->nama) }}" placeholder="Nama">
                  @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="email">{{ __('Email') }} <span class="text-danger">*</span></label>
                  <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->email) }}" placeholder="Email">
                  @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="phone">{{ __('Nomor Telepon') }} <span class="text-danger">*</span></label>
                  <input type="phone" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', auth()->user()->no_telp) }}" placeholder="Nomor Telepon">
                  @error('phone')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="gender">{{ __('Jenis Kelamin') }} <span class="text-danger">*</span></label>
                  <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                    <option selected disabled>{{ __('Pilih jenis kelamin') }}</option>
                    <option value="Laki-Laki" @if(Request::old('gender') == 'Laki-Laki' || ($user->pegawai && $user->pegawai->jenis_kelamin && $user->pegawai->jenis_kelamin == 'Laki-Laki')) selected @endif>{{ __('Laki-Laki') }}</option>
                    <option value="Perempuan" @if(Request::old('gender') == 'Perempuan' || ($user->pegawai && $user->pegawai->jenis_kelamin && $user->pegawai->jenis_kelamin == 'Perempuan')) selected @endif>{{ __('Perempuan') }}</option>
                  </select>
                  @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              {{-- <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="dinas_id">{{ __('Dinas') }} <span class="text-danger">*</span></label>
                  <select name="dinas_id" id="dinas_id" class="form-control @error('dinas_id') is-invalid @enderror">
                    <option selected disabled>{{ __('Pilih dinas') }}</option>
                    @foreach ($dinas as $item)
                      <option value="{{ $item->id }}" @if(Request::old('dinas_id') == $item->id || (auth()->user()->dinas_id == $item->id)) selected @endif>{{ $item->nama }}</option>
                    @endforeach
                  </select>
                  @error('dinas_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="sub_bidang_id">{{ __('Bidang') }} <span class="text-danger">*</span></label>
                  <select name="sub_bidang_id" id="sub_bidang_id" class="form-control @error('sub_bidang_id') is-invalid @enderror">
                    <option selected disabled>{{ __('Pilih bidang') }}</option>
                    <div id="sub-bidang-option">
                      @if ($sub_bidang)
                        @foreach ($sub_bidang as $item)
                          <option value="{{ $item->id }}" @if($item->id == $user->sub_bidang_id) selected @endif>{{ $item->nama }}</option>
                        @endforeach
                      @endif
                    </div>
                  </select>
                  @error('sub_bidang_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div> --}}
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="pob">{{ __('Tempat Lahir') }} <span class="text-danger">*</span></label>
                  <input type="text" name="pob" id="pob" class="form-control @error('pob') is-invalid @enderror" value="{{ old('pob', $user->pegawai && $user->pegawai->tempat_lahir ? $user->pegawai->tempat_lahir : '') }}" placeholder="Tempat Lahir">
                  @error('pob')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="dob">{{ __('Tanggal Lahir') }} <span class="text-danger">*</span></label>
                  <input type="date" name="dob" id="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob', $user->pegawai && $user->pegawai->tanggal_lahir ? $user->pegawai->tanggal_lahir : '') }}" placeholder="Tanggal Lahir">
                  @error('dob')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="pangkat">{{ __('Pangkat') }} <span class="text-danger">*</span></label>
                  <input type="text" name="pangkat" id="pangkat" class="form-control @error('pangkat') is-invalid @enderror" value="{{ old('pangkat', $user->pegawai && $user->pegawai->pangkat ? $user->pegawai->pangkat : '') }}" placeholder="Pangkat">
                  @error('pangkat')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              {{-- <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="tmt_pangkat">{{ __('TMT Pangkat') }} <span class="text-danger">*</span></label>
                  <input type="date" name="tmt_pangkat" id="tmt_pangkat" class="form-control @error('tmt_pangkat') is-invalid @enderror" value="{{ old('tmt_pangkat', $user->pegawai && $user->pegawai->tmt_pangkat ? $user->pegawai->tmt_pangkat : '') }}" placeholder="TMT Pangkat">
                  @error('tmt_pangkat')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div> --}}
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="golongan">{{ __('Golongan') }} <span class="text-danger">*</span></label>
                  <input type="text" name="golongan" id="golongan" class="form-control @error('golongan') is-invalid @enderror" value="{{ old('golongan', $user->pegawai && $user->pegawai->golongan ? $user->pegawai->golongan : '') }}" placeholder="Golongan">
                  @error('golongan')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              {{-- <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="tmt_golongan">{{ __('TMT Golongan') }} <span class="text-danger">*</span></label>
                  <input type="date" name="tmt_golongan" id="tmt_golongan" class="form-control @error('tmt_golongan') is-invalid @enderror" value="{{ old('tmt_golongan', $user->pegawai && $user->pegawai->tmt_golongan ? $user->pegawai->tmt_golongan : '') }}" placeholder="TMT Golongan">
                  @error('tmt_golongan')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div> --}}
              {{-- <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="tgl_awal_pengangkatan">{{ __('Tanggal Awal Pengangkatan') }} <span class="text-danger">*</span></label>
                  <input type="date" name="tgl_awal_pengangkatan" id="tgl_awal_pengangkatan" class="form-control @error('tgl_awal_pengangkatan') is-invalid @enderror" value="{{ old('tgl_awal_pengangkatan', $user->pegawai && $user->pegawai->tgl_awal_pengangkatan ? $user->pegawai->tgl_awal_pengangkatan : '') }}" placeholder="Tanggal Awal Pengangkatan">
                  @error('tgl_awal_pengangkatan')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div> --}}
              {{-- <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="status_kepegawaian">{{ __('Status Kepegawaian') }} <span class="text-danger">*</span></label>
                  <input type="text" name="status_kepegawaian" id="status_kepegawaian" class="form-control @error('status_kepegawaian') is-invalid @enderror" value="{{ old('status_kepegawaian', $user->pegawai && $user->pegawai->status_kepegawaian ? $user->pegawai->status_kepegawaian : '') }}" placeholder="Status Kepegawaian">
                  @error('status_kepegawaian')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div> --}}
              
              <div class="col-12 d-flex justify-content-end">
                <a href="{{ route('user.profile.index') }}" class="btn btn-light-secondary me-1 mb-1">{{ __('Batal') }}</a>
                <button type="submit" class="btn btn-primary me-1 mb-1">{{ __('Perbarui') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('js')
  <script type="text/javascript">
    $(document).ready(function() {
      $('#dinas_id').on('change', function() {
        var dinas_id = $(this).val();

        $.get('{{ route('bidang.select') }}', {dinas_id: dinas_id}, function(data) {
          $('#sub_bidang_id').empty();
          $('#sub_bidang_id').append('<option selected disabled>{{ __('Pilih bidang') }}</option>');
          $('#sub_bidang_id').append(data);
        });
      });
    });
  </script>
@endpush
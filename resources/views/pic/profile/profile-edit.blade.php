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

      <div class="card">
        <div class="card-header">
          <h4 class="card-title">{{ __('Form Ubah Data Diri') }}</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('pic.profile.update') }}" method="post">
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
                  @error('jenis_kelamin')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            
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
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="golongan">{{ __('Golongan') }} <span class="text-danger">*</span></label>
                  <input type="text" name="golongan" id="golongan" class="form-control @error('golongan') is-invalid @enderror" value="{{ old('golongan', $user->pegawai && $user->pegawai->golongan ? $user->pegawai->golongan : '') }}" placeholder="Golongan">
                  @error('golongan')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              
              <div class="col-12 d-flex justify-content-end">
                <a href="{{ route('pic.profile.index') }}" class="btn btn-light-secondary me-1 mb-1">{{ __('Batal') }}</a>
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
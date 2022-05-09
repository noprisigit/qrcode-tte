@extends('main')

@section('title', 'Tambah Pengguna')

@section('content')
@if (Session::has('success'))
  <div class="alert alert-primary text-center">
    {!! Session::get('success') !!}
  </div>
@endif

@if (Session::has('error'))
  <div class="alert alert-danger text-center">
    {!! Session::get('error') !!}
  </div>
@endif

<div class="card shadow mb-4">
  <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Form Tambah Pengguna</h6>
  </div>
  <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 col-12">
          <div class="form-group">
            <label for="nik">NIK</label>
            <input type="number" min="0" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" placeholder="NIK">
            @error('nik')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="form-group">
            <label for="nip">NIP</label>
            <input type="number" min="0" name="nip" id="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}" placeholder="NIP">
            @error('nip')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Nama">
            @error('nama')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email">
            @error('email')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="form-group">
            <label for="no_telp">Nomor Telepon</label>
            <input type="number" min="0" name="no_telp" id="no_telp" class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp') }}" placeholder="Nomor Telepon">
            @error('no_telp')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
              <option selected disabled>{{ __('Pilih jenis kelamin') }}</option>
              <option value="Laki-Laki" @if(Request::old('jenis_kelamin') == 'Laki-Laki') selected @endif>{{ __('Laki-Laki') }}</option>
              <option value="Perempuan" @if(Request::old('jenis_kelamin') == 'Perempuan') selected @endif>{{ __('Perempuan') }}</option>
            </select>
            @error('jenis_kelamin')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="form-group">
            <label for="tempat_lahir">{{ __('Tempat Lahir') }}</label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" placeholder="Tempat Lahir">
            @error('tempat_lahir')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="form-group">
            <label for="tanggal_lahir">{{ __('Tanggal Lahir') }}</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}" placeholder="Tanggal Lahir">
            @error('tanggal_lahir')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="col-sm-6 mb-3 mb-sm-0">
          <div class="form-group">
            <label for="">Dinas</label>
            <select name="dinas_id" id="dinas_id" class="form-control @error('dinas_id') is-invalid @enderror">
              <option selected disabled>Pilih Dinas</option>
              @foreach ($dinas as $item)
                @if (Request::old('dinas_id') == $item->id)  
                  <option value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                @else
                  <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endif
              @endforeach
            </select>
            @error('dinas_id')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="">Bidang</label>
            <select name="sub_bidang_id" id="sub_bidang_id" class="form-control @error('sub_bidang_id') is-invalid @enderror">
              <option selected disabled>Pilih Bidang</option>
            </select>
            @error('sub_bidang_id')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="form-group">
            <label for="pangkat">{{ __('Pangkat') }}</label>
            <input type="text" name="pangkat" id="pangkat" class="form-control @error('pangkat') is-invalid @enderror" value="{{ old('pangkat') }}" placeholder="Pangkat">
            @error('pangkat')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="form-group">
            <label for="golongan">{{ __('Golongan') }}</label>
            <input type="text" name="golongan" id="golongan" class="form-control @error('golongan') is-invalid @enderror" value="{{ old('golongan') }}" placeholder="Golongan">
            @error('golongan')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="form-group">
            <label for="ktp">{{ __('File KTP') }}</label>
            <input type="file" name="ktp" id="ktp" class="form-control @error('ktp') is-invalid @enderror" value="{{ old('ktp') }}" placeholder="File KTP">
            @error('ktp')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="form-group">
            <label for="sk_terakhir">{{ __('File SK Terakhir') }}</label>
            <input type="file" name="sk_terakhir" id="sk_terakhir" class="form-control @error('sk_terakhir') is-invalid @enderror" value="{{ old('sk_terakhir') }}" placeholder="File SK Terakhir">
            @error('sk_terakhir')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="form-group">
            <label for="role">{{ __('File SK Terakhir') }}</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="role" id="role_admin" value="{{ \App\Models\User::ROLE_ADMIN }}">
              <label class="form-check-label" for="role_admin">
                Administrator
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="role" id="role_pic" value="{{ \App\Models\User::ROLE_PIC }}">
              <label class="form-check-label" for="role_pic">
                PIC
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="role" id="role_user" value="{{ \App\Models\User::ROLE_USER }}">
              <label class="form-check-label" for="role_user">
                User
              </label>
            </div>
            @error('role')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="col-12 d-flex justify-content-end mt-3">
          <a href="{{ route('admin.user.create') }}" class="btn btn-light-secondary me-1 mb-1">{{ __('Batal') }}</a>
          <button type="submit" class="btn btn-primary me-1 mb-1">{{ __('Simpan') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection

@push('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#dinas_id').on('change', function() {
      var dinas_id = $(this).val();

      $.get('{{ route('bidang.select') }}', {dinas_id: dinas_id}, function(data) {
        $('#sub_bidang_id').empty();
        $('#sub_bidang_id').append('<option selected disabled>{{ __('Pilih Bidang') }}</option>');
        $('#sub_bidang_id').append(data);
      });
    });
  });
</script>
@endpush
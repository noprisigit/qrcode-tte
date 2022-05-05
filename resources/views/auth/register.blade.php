<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Register</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Daftar</h1>
              </div>

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
              
              <form class="user" action="{{ route('register.doRegister') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ old('nama') }}">
                    @error('nama')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-sm-6">
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                      <option selected disabled>Pilih Jenis Kelamin</option>
                      <option value="Laki-Laki" @if(Request::old('jenis_kelamin') == 'Laki-Laki') selected @endif>Laki-Laki</option>
                      <option value="Perempuan" @if(Request::old('jenis_kelamin') == 'Perempuan') selected @endif>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="number" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="NIK" value="{{ old('nik') }}">
                    @error('nik')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-sm-6">
                    <input type="number" name="nip" id="nip" class="form-control @error('nip') is-invalid @enderror" placeholder="NIP" value="{{ old('nip') }}">
                    @error('nip')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-sm-6">
                    <input type="number" name="no_telp" id="no_telp" class="form-control @error('no_telp') is-invalid @enderror" placeholder="Nomor Telepon" value="{{ old('no_telp') }}">
                    @error('no_telp')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}">
                    @error('tempat_lahir')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-sm-6">
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="Tanggal Lahir" value="{{ old('tanggal_lahir') }}">
                    @error('tanggal_lahir')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
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
                  <div class="col-sm-6">
                    <select name="sub_bidang_id" id="sub_bidang_id" class="form-control @error('sub_bidang_id') is-invalid @enderror">
                      <option selected disabled>Pilih Bidang</option>
                    </select>
                    @error('sub_bidang_id')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="golongan" id="golongan" class="form-control @error('golongan') is-invalid @enderror" placeholder="Golongan" value="{{ old('golongan') }}">
                    @error('golongan')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="pangkat" id="pangkat" class="form-control @error('pangkat') is-invalid @enderror" placeholder="Pangkat" value="{{ old('pangkat') }}">
                    @error('pangkat')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                      placeholder="Kata Sandi">
                    @error('password')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-sm-6">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                      class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Ulangi Kata Sandi">
                    @error('password_confirmation')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="file" name="ktp" id="ktp" class="@error('ktp') is-invalid @enderror"
                    placeholder="KTP">
                    <label for="ktp" class="badge badge-dark">KTP <span class="text-danger">*</span></label>
                    @error('ktp')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-sm-6">
                    <input type="file" name="sk_terakhir" id="sk_terakhir" class="@error('sk_terakhir') is-invalid @enderror"
                      placeholder="SK Terakhir">
                    <label for="sk_terakhir" class="badge badge-dark">SK Terakhir <span class="text-danger">*</span></label>
                    @error('sk_terakhir')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Daftar
                </button>
              </form>
              <hr>
              {{-- <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div> --}}
              <div class="text-center">
                <a class="small" href="{{ route('login') }}">{{ __('Sudah punya akun? Masuk') }}</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

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

</body>

</html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet" />
  </head>

  <body class="bg-gradient-primary">
    <div class="container">
      <!-- Outer Row -->
      <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-lg-6 d-flex justify-content-center align-items-center">
                    <img class="img-fluid" width="50%" src="{{ asset('assets/img/logo/logo-babel.png') }}" alt="Logo Bangka Belitung">
                </div>
                <div class="col-lg-6">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">Masuk</h1>
                    </div>
                    @if (Session::has('success'))
                      <div class="alert alert-primary text-center"><i class="bi bi-check-circle me-2"></i> {{ Session::get('success') }}</div>
                    @endif

                    @if (Session::has('error'))
                      <div class="alert alert-danger text-center"><i class="bi bi-exclamation-circle"></i> {{ Session::get('error') }}</div>
                    @endif
                    <form action="{{ route('login.doLogin') }}" method="POST" class="user">
                      @csrf
                      <div class="form-group">
                        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" id="email"  placeholder="Email..." />
                        @error('email')
                          <div class="text-danger mb-3">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" />
                        @error('password')
                          <div class="text-danger mb-3">{{ $message }}</div>
                        @enderror
                      </div>

                      <button type="submit" class="btn btn-primary btn-user btn-block">
                        Masuk
                      </button>
                    </form>
                    <hr />
                    {{-- <div class="text-center">
                      <a class="small" href="forgot-password.html">Forgot Password?</a>
                    </div> --}}
                    <div class="text-center">
                      <a class="small" href="{{ route('register') }}">{{ __('Belum punya akun?') }}</a>
                    </div>
                  </div>
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
  </body>
</html>


{{-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - SITTE</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">
</head>

<body>
  <div id="auth">

    <div class="row h-100">
      <div class="col-lg-7 col-12">
        <div id="auth-left">
          <div class="mb-5 text-center">
            <a href="{{ route('auth.login') }}"><img src="{{ asset('assets/images/logo/logo_babel.png') }}" class="img-fluid" width="15%" alt="Logo"></a>
          </div>
          <h1 class="auth-title">{{ __('Masuk') }}</h1>
          <p class="auth-subtitle mb-5">{{ __('Masuk dengan data Anda yang Anda masukkan saat pendaftaran.') }}</p>

          @if (Session::has('success'))
            <div class="alert alert-primary"><i class="bi bi-check-circle me-2"></i> {{ Session::get('success') }}</div>
          @endif

          @if (Session::has('error'))
            <div class="alert alert-danger"><i class="bi bi-exclamation-circle"></i> {{ Session::get('error') }}</div>
          @endif

          <form action="{{ route('auth.login.process') }}" method="POST">
            @csrf
            <div class="form-group position-relative has-icon-left @error('email') mb-0 @else mb-3 @enderror">
              <input type="email" name="email" id="email" class="form-control form-control-xl @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
              <div class="form-control-icon">
                <i class="bi bi-person"></i>
              </div>
            </div>
            @error('email')
              <div class="text-danger mb-3">{{ $message }}</div>
            @enderror

            <div class="form-group position-relative has-icon-left @error('password') mb-0 @else mb-3 @enderror">
              <input type="password" name="password" id="password" class="form-control form-control-xl @error('password') is-invalid @enderror" placeholder="Password">
              <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
              </div>
            </div>
            @error('password')
              <div class="text-danger mb-3">{{ $message }}</div>
            @enderror

            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">{{ __('Masuk') }}</button>
          </form>
          <div class="text-center mt-5 text-lg fs-4">
            <p class="text-gray-600">{{ __('Belum punya akun?') }} <a href="{{ route('register') }}" class="font-bold">{{ __('Daftar') }}</a>.</p>
            <p><a class="font-bold" href="auth-forgot-password.html">{{ __('Lupa kata sandi?') }}</a>.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-5 d-none d-lg-block">
        <div id="auth-right">
        </div>
      </div>
    </div>

  </div>
</body>

</html> --}}
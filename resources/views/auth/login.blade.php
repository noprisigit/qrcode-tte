<!DOCTYPE html>
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

            {{-- <div class="form-check form-check-lg d-flex align-items-end">
              <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label text-gray-600" for="flexCheckDefault">
                Keep me logged in
              </label>
            </div> --}}
            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">{{ __('Masuk') }}</button>
          </form>
          <div class="text-center mt-5 text-lg fs-4">
            <p class="text-gray-600">{{ __('Belum punya akun?') }} <a href="{{ route('auth.register') }}" class="font-bold">{{ __('Daftar') }}</a>.</p>
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

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Mazer Admin Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">
</head>

<body>
  <div id="auth">

    <div class="row h-100">
      <div class="col-lg-5 col-12">
        <div id="auth-left">
          <div class="auth-logo">
            <a href="{{ route('auth.register') }}"><img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo"></a>
          </div>
          <h1 class="auth-title">{{ __('Daftar') }}</h1>
          <p class="auth-subtitle mb-4">{{ __('Silahkan isi dengan data yang valid') }}.</p>

          <form action="{{ route('auth.register.process') }}" method="POST">
            @csrf
            <div class="form-group position-relative has-icon-left @error('name') mb-0 @else mb-3 @enderror">
              <input type="text" name="name" id="name" class="form-control form-control-xl @error('name') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ old('name') }}">
              <div class="form-control-icon">
                <i class="bi bi-person"></i>
              </div>
            </div>
            @error('name')
              <div class="text-danger mb-3">{{ $message }}</div>
            @enderror

            <div class="form-group position-relative has-icon-left @error('email') mb-0 @else mb-3 @enderror">
              <input type="email" name="email" id="email" class="form-control form-control-xl @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
              <div class="form-control-icon">
                <i class="bi bi-envelope"></i>
              </div>
            </div>
            @error('email')
              <div class="text-danger mb-3">{{ $message }}</div>
            @enderror

            <div class="form-group position-relative has-icon-left @error('password') mb-0 @else mb-3 @enderror">
              <input type="password" name="password" id="password" class="form-control form-control-xl @error('password') is-invalid @enderror" placeholder="Kata Sandi">
              <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
              </div>
            </div>
            @error('password')
              <div class="text-danger mb-3">{{ $message }}</div>
            @enderror

            <div class="form-group position-relative has-icon-left @error('password_confirmation') mb-0 @else mb-3 @enderror">
              <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-xl @error('password_confirmation') is-invalid @enderror" placeholder="Konfirmasi Kata Sandi">
              <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
              </div>
            </div>
            @error('password_confirmation')
              <div class="text-danger mb-3">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-3">{{ __('Daftar') }}</button>
          </form>
          <div class="text-center mt-4 text-lg fs-4">
            <p class='text-gray-600'>{{ __('Sudah punya akun?') }} <a href="{{ route('auth.login') }}" class="font-bold">{{ __('Masuk') }}</a>.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
      </div>
    </div>

  </div>
</body>

</html>
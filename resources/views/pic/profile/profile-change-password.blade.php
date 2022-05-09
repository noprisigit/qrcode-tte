@extends('main')

@section('title', 'Ubah Kata Sandi')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-12 col-md-8 col-lg-8">

      @if (Session::has('success'))
        <div class="alert alert-success notification">{{ Session::get('success') }}</div>
      @endif
      
      @if (Session::has('error'))
        <div class="alert alert-danger notification">{{ Session::get('error') }}</div>
      @endif

      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary">Form Ubah Kata Sandi</h6>
        </div>
        <div class="card-body">
          <form action="{{ route('pic.profile.change-password.process') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-md-12 col-12">
                <div class="form-group">
                  <label for="old_password">{{ __('Kata Sandi Lama') }} <span class="text-danger">*</span></label>
                  <input type="password" name="old_password" id="old_password" class="form-control @error('old_password') is-invalid @enderror" value="{{ old('old_password') }}" placeholder="Kata Sandi Lama">
                  @error('old_password')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="new_password">{{ __('Kata Sandi Baru') }} <span class="text-danger">*</span></label>
                  <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" value="{{ old('new_password') }}" placeholder="Kata Sandi Baru">
                  @error('new_password')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="new_password_confirmation">{{ __('Konfirmasi Kata Sandi Baru') }} <span class="text-danger">*</span></label>
                  <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror" value="{{ old('new_password_confirmation') }}" placeholder="Konfirmasi Kata Sandi">
                  @error('new_password_confirmation')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-12 d-flex justify-content-end">
                <a href="{{ route('pic.profile.index') }}" class="btn btn-light-secondary me-1 mb-1">{{ __('Batal') }}</a>
                <button type="submit" class="btn btn-primary me-1 mb-1">{{ __('Ubah Kata Sandi') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
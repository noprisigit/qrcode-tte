@extends('main')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('content')
<section class="section">

  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <h4 class="card-title">{{ __('Cetak QrCode') }}</h4>
          </div>
        </div>
        <div class="card-body">

          @if (Session::has('success'))
            <div class="alert alert-success notification">{{ Session::get('success') }}</div>
          @endif

          @if (Session::has('error'))
            <div class="alert alert-danger notification">{{ Session::get('error') }}</div>
          @endif

          <div class="row mb-4">
            <div class="col-md-6">
              
              @if ($qrcodeLogo)
                <img src="{{ asset('storage/' . $qrcodeLogo->logo) }}" alt="Logo" class="img-thumbnail d-flex mx-auto" width="150" height="150">
              @else
                <p class="text-danger">{{ __('Belum ada logo') }}</p>
              @endif
            </div>
            <div class="col-md-6">
              <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalUploadLogo">{{
                __('Unggah Logo') }}</button>
    
              <div class="modal fade text-left" id="modalUploadLogo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="myModalLabel1">{{ __('Unggah Logo') }}</h5>
                      <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                      </button>
                    </div>
                    <form id="form-upload-logo" action="{{ route('user.generate-qrcode.upload-logo') }}" method="POST">
                      @csrf
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="logo">{{ __('Logo') }}</label>
                          <input type="file" name="logo" id="logo" class="form-control">
                          <span class="invalid-feedback" id="logo"></span>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                          <i class="bx bx-x d-block d-sm-none"></i>
                          <span class="d-none d-sm-block">Tutup</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                          <i class="bx bx-check d-block d-sm-none"></i>
                          <span class="d-none d-sm-block">Unggah</span>
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <form id="form-generate-qrcode" action="{{ route('user.generate-qrcode.generate') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="size">{{ __('Ukuran QrCode') }}</label>
              <input type="number" class="form-control" name="size" id="size" value="100" min="100"
                placeholder="Ukuran QrCode">
              <span class="invalid-feedback" id="size"></span>
            </div>

            <div class="form-check">
              <div class="checkbox">
                <input type="checkbox" id="with_logo" name="with_logo" class="form-check-input">
                <label for="with_logo">Cetak dengan logo?</label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">{{ __('Cetak QrCode') }}</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <h4 class="card-title">{{ __('Hasil QrCode') }}</h4>
          </div>
        </div>
        <div class="card-body text-center">
          <div id="qrcode-result">
            <img src="" alt="" id="qrcode-img">
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
@endsection

@push('js')
<script src="{{ asset('assets/js/extensions/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#form-generate-qrcode').submit(function(e) {
    e.preventDefault();
    
    Swal.fire({
      title: "{{ __('Cetak QrCode?') }}",
      text: "{{ __('Apakah anda yakin untuk mencetak QrCode anda?') }}",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: 'Ya, Cetak!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "{{ route('user.generate-qrcode.generate') }}",
          type: "POST",
          data: $('#form-generate-qrcode').serialize(),
          beforeSend: function() {
            before_submit('#form-generate-qrcode');
          },
          success: function(res) {
            if (res.status === false) {
              location.reload();
            }

            console.log(res);

            $('#qrcode-img').attr('src', `data:image/png;base64, ${res}`);
          },
          error: function(err) {
            error_submit(err);
          },
          complete: function() {
            complete_submit('#form-generate-qrcode', 'Cetak QrCode');
          }
        });
      }
    });
  });

  $('#form-upload-logo').submit(function(e) {
    e.preventDefault();

    $.ajax({
      url: $(this).attr('action'),
      type: $(this).attr('method'),
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function() {
        before_submit('#form-upload-logo');
      },
      success: function(res) {
        if (res.status === true) {
          location.reload();
        }
      },
      error: function(err) {
        error_submit(err);
      },
      complete: function() {
        complete_submit('#form-upload-logo', 'Unggah Logo');
      }
    });
  });
});
</script>
@endpush
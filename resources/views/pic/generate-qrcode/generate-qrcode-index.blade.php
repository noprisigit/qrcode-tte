@extends('main')

@section('title', 'Cetak Tanda Tangan Elektronik')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('content')
<section class="section">

  <div class="row">
    <div class="col-md-5">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <h4 class="card-title">{{ __('Cetak Tanda Tangan Elektronik') }}</h4>
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
                    <form id="form-upload-logo" action="{{ route('pic.generate-qrcode.upload-logo') }}" method="POST">
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

          <form id="form-generate-qrcode" action="{{ route('pic.generate-qrcode.generate') }}" method="POST">
            @csrf

            <div class="form-check">
              <div class="checkbox">
                <input type="checkbox" id="with_logo" name="with_logo" class="form-check-input">
                <label for="with_logo">Cetak dengan logo?</label>
              </div>
            </div>
            
            <button type="button" class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#modalUploadLogo">{{
              __('Unggah Logo') }}</button>
            <button type="submit" class="btn btn-primary mt-3">{{ __('Cetak Tanda Tangan Elektronik') }}</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <h4 class="card-title">{{ __('Hasil Tanda Tangan Elektronik') }}</h4>
          </div>
        </div>
        <div class="card-body text-center">
          <div id="qrcode-result">
            <img src="" alt="" id="qrcode-img">
          </div>
          <div id="btn-download"></div>
        </div>
      </div>
    </div>
  </div>

</section>
@endsection

@push('js')
<script src="{{ asset('assets/js/extensions/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.esm.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.js"></script>
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

            $('#qrcode-result').html(res.html);
            $('#btn-download').html('<button type="button" id="download" onclick="screenshot()" class="btn btn-primary btn-block mt-3"><i class="fas fa-download"></i> {{ __('Unduh') }}</button>');
          },
          error: function(err) {
            error_submit(err);
          },
          complete: function() {
            complete_submit('#form-generate-qrcode', 'Cetak Tanda Tangan Elektronik');
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

  $(document).on('click', '#download', function() {
    screenshot();
  });
});

function screenshot(){
	   html2canvas(document.getElementById("qrcode-result")).then(function(canvas){
          downloadImage(canvas.toDataURL(),"Tanda Tangan Elektronik.png");
	   });
   }

   function downloadImage(uri, filename){
	 var link = document.createElement('a');
	 if(typeof link.download !== 'string'){
        window.open(uri);
	 }
	 else{
		 link.href = uri;
		 link.download = filename;
		 accountForFirefox(clickLink, link);
	 }
   }

   function clickLink(link){
	   link.click();
   }

   function accountForFirefox(click){
	   var link = arguments[1];
	   document.body.appendChild(link);
	   click(link);
	   document.body.removeChild(link);
   }
</script>
@endpush
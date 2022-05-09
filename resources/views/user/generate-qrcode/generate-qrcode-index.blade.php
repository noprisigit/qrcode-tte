@extends('main')

@section('title', 'Cetak Tanda Tangan Elektronik')

@section('css')
@endsection

@section('content')
<section class="section">

  <div class="row">
    <div class="col-md-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Cetak Tanda Tangan Elektronik</h6>
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
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="myModalLabel1">{{ __('Unggah Logo') }}</h5>
                      <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
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
                        <button type="button" class="btn btn-light" data-dismiss="modal">
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
            {{-- <div class="form-group">
              <label for="size">{{ __('Ukuran QrCode') }}</label>
              <input type="number" class="form-control" name="size" id="size" value="100" min="100"
                placeholder="Ukuran QrCode">
              <span class="invalid-feedback" id="size"></span>
            </div> --}}

            <div class="form-check">
              <div class="checkbox">
                <input type="checkbox" id="with_logo" name="with_logo" class="form-check-input">
                <label for="with_logo">Cetak dengan logo?</label>
              </div>
            </div>
            
            <button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#modalUploadLogo">{{
              __('Unggah Logo') }}</button>
            <button type="submit" class="btn btn-primary mt-3">{{ __('Cetak Tanda Tangan Elektronik') }}</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-10">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Hasil Tanda Tangan Elektronik</h6>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.all.min.js"></script>
{{-- <script type="text/javascript" src="{{ asset('assets/js/extensions/html2canvas.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/extensions/html2canvas.esm.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/extensions/html2canvas.js') }}"></script> --}}
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.esm.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.js"></script> --}}
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
            $('#btn-download').html('<button type="button" id="download" class="btn btn-primary btn-block mt-3"><i class="fas fa-paper-plane"></i> {{ __('Kirim Ke Email') }}</button>');
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
    html2canvas(document.getElementById("qrcode-result")).then(function(canvas){
      var img = canvas.toDataURL("image/png");

      $.ajax({
        url: "{{ route('user.generate-qrcode.sendToMail') }}",
        type: "POST",
        data: {
          _token: '{{ csrf_token() }}',
          img: img
        },
        dataType: 'json',
        beforeSend: function() {
          $(document).find('#download').attr('disabled', true);
          $(document).find('#download').html('<i class="fas fa-spin fa-spinner"></i>');
        },
        success: function(res) {
          alert('Tanda tangan elektronik telah dikirimkan ke email anda');
        },
        error: function(err) {
          alert(err.responseText);
        },
        complete: function() {
          $(document).find('#download').attr('disabled', false);
          $(document).find('#download').html('<i class="fas fa-paper-plane"></i> Kirim Ke Email');
        }
      });
    });
  });
});
</script>
@endpush
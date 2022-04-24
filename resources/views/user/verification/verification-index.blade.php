@extends('main')

@section('title', 'Proses Verifikasi')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('content')
<section class="section">

  @if (Session::has('success'))
    <div class="alert alert-success notification">{{ Session::get('success') }}</div>
  @endif
  
  @if (Session::has('error'))
    <div class="alert alert-danger notification">{{ Session::get('error') }}</div>
  @endif

  @if ($verifications->count() < 1)
    <div class="alert alert-warning">{{ __('Belum ada perubahan data dari anda.') }}</div>
  @else
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <h4 class="card-title">{{ __('Verifikasi Data') }}</h4>
          <button type="button" class="btn btn-dark" onclick="reset_verifikasi({{ auth()->user()->id }})">{{ __('Reset Verifikasi') }}</button>
        </div>
      </div>
      <div class="card-body">
        <table class="table text-dark">
          <tbody>
            @foreach ($verifications as $item)
              <tr>
                <th class="border-bottom-0" width="19%">{{ $item->label }}</th>
                <th class="border-bottom-0" width="1%">:</th>
                <td class="border-bottom-0">
                  @if ($item->type == 'date')
                    {{ \Carbon\Carbon::create($item->value)->isoFormat('D MMMM Y') }}
                  @elseif ($item->name == 'dinas_id')
                    {{ \App\Models\Dinas::find($item->value)->nama }}
                  @elseif ($item->name == 'sub_bidang_id')
                    {{ \App\Models\Bidang::find($item->value)->nama }}
                  @else
                    {{ $item->value }}
                  @endif

                </td>
                <td class="border-bottom-0">
                  @if ($item->status == \App\Models\VerifikasiPegawai::STATUS_WAITING)
                    <span class="badge bg-secondary">{{ __('Menunggu Verifikasi') }}</span>
                  @endif

                  @if ($item->status == \App\Models\VerifikasiPegawai::STATUS_ACCEPTED)
                    <span class="badge bg-success">{{ __('Pengajuan Diterima') }}</span>
                  @endif
                  
                  @if ($item->status == \App\Models\VerifikasiPegawai::STATUS_REJECTED)
                    <span class="badge bg-danger">{{ __('Pengajuan Ditolak') }}</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
      
  @endif

</section>

@endsection

@push('js')
<script src="{{ asset('assets/js/extensions/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script type="text/javascript">
  function reset_verifikasi(id) {
    new swal({
      title: "{{ __('Reset Verifikasi?') }}",
      text: "{{ __('Apakah anda yakin akan mereset verifikasi data?') }}",
      icon: "warning",
      buttons: true,
      dangerMode: true,
      showCancelButton: true,
    }).then((willDelete) => {
      if (willDelete.isConfirmed) {
        $.ajax({
          url: "{{ route('user.verification.reset') }}",
          type: "POST",
          data: {
            id: id,
            _token: "{{ csrf_token() }}"
          },
          success: function(data) {
            location.reload()
          }
        });
      }
    });
            
  }
</script>
@endpush
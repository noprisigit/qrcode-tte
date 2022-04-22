@extends('main')

@section('content')
<section class="section">

  @if (Session::has('success'))
    <div class="alert alert-success notification">{{ Session::get('success') }}</div>
  @endif
  
  @if (Session::has('error'))
    <div class="alert alert-danger notification">{{ Session::get('error') }}</div>
  @endif

  @if ($pegawai->count() < 1) 
    <div class="alert alert-danger">{{ __('Data tidak ditemukan') }}</div>
  @else
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <h4 class="card-title">{{ __('Data Pegawai') }}</h4>
        </div>

      </div>
      <div class="card-body">
        <table class="table text-dark">
          <tbody>
            @foreach ($pegawai as $item)
              <tr>
                <th class="border-bottom-0" width="19%">{{ $item->label }}</th>
                <th class="border-bottom-0" width="1%">:</th>
                <td class="border-bottom-0" width="40%">
                  @if ($item->name == 'dinas_id')
                    <input type="text" class="form-control" value="{{ \App\Models\Dinas::find($item->value)->nama }}" readonly>
                  @elseif ($item->name == 'sub_bidang_id')
                    <input type="text" class="form-control" value="{{ \App\Models\Bidang::find($item->value)->nama }}" readonly>
                  @elseif ($item->type == 'date')
                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::create($item->value)->isoFormat('D MMMM Y') }}" readonly>
                  @else
                    <input type="text" class="form-control" value="{{ $item->value }}" readonly>
                  @endif

                </td>
                <td class="border-0" id="result-{{ $item->id }}">
                  @if ($item->status == \App\Models\VerifikasiPegawai::STATUS_WAITING)
                    <button class="btn btn-success btn-sm" onclick="accept({{ $item->id }})"><i class="fas fa-check me-2"></i> {{ __('Terima') }}</button>
                    <button class="btn btn-danger btn-sm" onclick="reject({{ $item->id }})"><i class="fas fa-times me-2"></i> {{ __('Tolak') }}</button>
                  @elseif ($item->status == \App\Models\VerifikasiPegawai::STATUS_ACCEPTED)
                    <span class="text-success">{{ __('Diterima') }}</span>
                  @elseif ($item->status == \App\Models\VerifikasiPegawai::STATUS_REJECTED)
                    <span class="text-danger">{{ __('Ditolak') }}</span>
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
  <script type="text/javascript">
    function accept(id) {
      $.ajax({
        url: '{{ route('pic.verification.accept') }}',
        type: 'POST',
        data: { 
          id: id,
          _token: '{{ csrf_token() }}'
        },
        dataType: 'JSON',
        beforeSend: function() {
          $(`#result-${id}`).html('<i class="fas fa-spin fa-spinner text-success me-2"></i> Proses...');
        },
        error: function (err) {
          console.log(err);
        }, 
        complete: function() {
          $(`#result-${id}`).html('<span class="text-success">{{ __('Diterima') }}</span>');
        }
      });

      return false;
    }
    
    function reject(id) {
      $.ajax({
        url: '{{ route('pic.verification.reject') }}',
        type: 'POST',
        data: { 
          id: id,
          _token: '{{ csrf_token() }}'
        },
        dataType: 'JSON',
        beforeSend: function() {
          $(`#result-${id}`).html('<i class="fas fa-spin fa-spinner text-success me-2"></i> Proses...');
        },
        error: function (err) {
          console.log(err);
        }, 
        complete: function() {
          $(`#result-${id}`).html('<span class="text-danger">{{ __('Ditolak') }}</span>');
        }
      });

      return false;
    }
  </script>
@endpush
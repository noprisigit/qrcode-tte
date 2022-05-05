@extends('main')

@section('title', $user->nama)

@section('css')
<link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="section">

  @if (Session::has('success'))
  <div class="alert alert-success notification">{{ Session::get('success') }}</div>
  @endif

  @if (Session::has('error'))
  <div class="alert alert-danger notification">{{ Session::get('error') }}</div>
  @endif

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('Detail') }}</h6>
    </div>
    <div class="card-body">
      <table width="100%">
        @foreach ($verify as $item)
          @if ($item->name != 'password' && $item->name != 'password_confirmation')
            <tr>
              <th width="25%">{{ $item->label }}</th>
              <th width="1%">:</th>
              <td>
                @if ($item->name == 'dinas_id')
                  {{ $user->dinas->nama }}
                @elseif ($item->name == 'sub_bidang_id')
                  {{ $user->bidang->nama }}
                @elseif ($item->name == 'tanggal_lahir')
                  {{ \Carbon\Carbon::create($item->value)->isoFormat('D MMMM Y') }}
                @elseif ($item->name == 'file_ktp')
                  <a href="{{ asset('storage/' . $item->value) }}" target="_blank" class="btn btn-rounded btn-sm btn-outline-primary"><i class="fas fa-eye mr-1"></i> KTP</a>
                @elseif ($item->name == 'file_sk_terakhir')
                  <a href="{{ asset('storage/' . $item->value) }}" target="_blank" class="btn btn-rounded btn-sm btn-outline-primary"><i class="fas fa-eye mr-1"></i> SK Terakhir</a>
                @else
                  {{ $item->value }}  
                @endif
              </td>
            </tr>
          @endif
        @endforeach
      </table>
    </div>
  </div>
</section>

@endsection

@push('js')
<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#data-table').DataTable();
  });
</script>
@endpush
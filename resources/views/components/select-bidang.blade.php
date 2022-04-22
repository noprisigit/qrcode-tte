@foreach ($options as $item)
  <option value="{{ $item->id }}" @if (Request::old('sub_bidang_id') == $item->id) selected @endif>{{ $item->nama }}</option>
@endforeach
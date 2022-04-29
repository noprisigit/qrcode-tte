<table class="">
  <tr>
    <td rowspan="4" class="ps-3 pt-4 pb-4 pe-2" style="border-left: 4px solid black; border-top: 4px solid black; border-bottom: 4px solid black;">
      <img src="{{ asset('storage/' . $output_filename) }}" alt="">
    </td>
    <td class="p-0 text-start ps-1 pt-4" style="vertical-align: top; border-top: 4px solid black; border-right: 4px solid black;">
      <p class="mb-0 text-dark" style="font-family:Arial, Helvetica, sans-serif; font-size: 20px;">Ditandatangani secara elektronik oleh :</p>
      <p class="mb-0 text-dark fw-bold text-uppercase" style="font-family:Arial, Helvetica, sans-serif; font-size: 20px;">@if (auth()->user()->dinas_id) {{ auth()->user()->dinas->nama }} @endif Provinsi Kepulauan Bangka Belitung</p>
    </td>
  </tr>
  <tr>
    <td class="p-0 text-start ps-1 pb-4 pe-4" style="vertical-align: bottom; border-bottom: 4px solid black; border-right: 4px solid black;">
      <p class="mb-0 text-dark fw-bold" style="font-family: Arial, Helvetica, sans-serif; font-size: 20px">{{ auth()->user()->nama }}</p>
      <p class="mb-0 text-dark" style="font-family: Arial, Helvetica, sans-serif; font-size: 18px;">
        @if (auth()->user()->pegawai) {{ auth()->user()->pegawai->pangkat }} @endif
        @if (auth()->user()->pegawai) ({{  auth()->user()->pegawai->golongan }}) @endif
      </p>
    </td>
  </tr>
</table>
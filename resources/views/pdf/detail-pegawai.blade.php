<!DOCTYPE html>
<html>

<head>
  <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style type="text/css">
    body {
      font-family: Arial, Helvetica, sans-serif;
      /* font-size: 12px; */
    }
  </style>
</head>

<body>

  <div class="container">
    
    <table class="table">
      <tr>
        <td class="pb-2" style="border-top: 0; border-bottom: 2px solid black;">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/08/Coat_of_arms_of_Bangka_Belitung_Islands.svg/1200px-Coat_of_arms_of_Bangka_Belitung_Islands.svg.png" width="60px" class="d-flex mx-auto" alt="Logo Bangka Belitung">
        </td>
        <td class="pb-2" style="border-top: 0; border-bottom: 2px solid black;">
          <h4 class="mb-1 text-center" style="font-weight: bold; text-transform: uppercase; font-size: 14px;">Pemerintah Provinsi Kepulauan Bangka Belitung</h4>
          <h3 class="mb-1 text-center" style="font-weight: bold; text-transform: uppercase; font-size: 16px;">{{ $user->dinas->nama }}</h3>
          <p class="mb-0 text-center" style="font-size: 8px;">Komplek Perkantoran Terpadu Pemerintah Provinsi Kepulauan Bangka Belitung</p>
          <p class="mb-0 text-center" style="font-size: 8px;">Jalan Pulau Bangka Kelurahan Air Itam Pangkalpinang. Telp/FAX (0717) 439234, 436134, 421966</p>
        </td>
      </tr>

    </table>
      
  
      <table class="table mt-4">
        <tr>
          <th width="30%" class="border-0 p-1">Nama</th>
          <th width="1%" class="border-0 p-1">:</th>
          <td class="border-0 p-1">{{ $user->nama }}</td>
        </tr>
        <tr>
          <th width="30%" class="border-0 p-1">Pangkat</th>
          <th width="1%" class="border-0 p-1">:</th>
          <td class="border-0 p-1">{{ $user->pegawai->pangkat }}</td>
        </tr>
        <tr>
          <th width="30%" class="border-0 p-1">Golongan</th>
          <th width="1%" class="border-0 p-1">:</th>
          <td class="border-0 p-1">{{ $user->pegawai->golongan }}</td>
        </tr>
        <tr>
          <th class="border-0 p-1" width="30%">Email</th>
          <th class="border-0 p-1" width="1%">:</th>
          <td class="border-0 p-1">{{ $user->email }}</td>
        </tr>
        <tr>
          <th class="border-0 p-1" width="30%">Dinas</th>
          <th class="border-0 p-1" width="1%">:</th>
          <td class="border-0 p-1">{{ $user->dinas->nama }}</td>
        </tr>
        <tr>
          <th class="border-0 p-1" width="30%">Bidang</th>
          <th class="border-0 p-1" width="1%">:</th>
          <td class="border-0 p-1">{{ $user->bidang->nama }}</td>
        </tr>
        <tr>
          <th class="border-0 p-1" width="30%">Jenis Kelamin</th>
          <th class="border-0 p-1" width="1%">:</th>
          <td class="border-0 p-1">{{ $user->pegawai->jenis_kelamin }}</td>
        </tr>
        <tr>
          <th class="border-0 p-1" width="30%">Tempat Lahir</th>
          <th class="border-0 p-1" width="1%">:</th>
          <td class="border-0 p-1">{{ $user->pegawai->tempat_lahir }}</td>
        </tr>
        <tr>
          <th class="border-0 p-1" width="30%">Tanggal Lahir</th>
          <th class="border-0 p-1" width="1%">:</th>
          <td class="border-0 p-1">{{ \Carbon\Carbon::create($user->pegawai->tanggal_lahir)->isoFormat('D MMMM Y') }}</td>
        </tr>
      </table>

  </div>

</body>

</html>
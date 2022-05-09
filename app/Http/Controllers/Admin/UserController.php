<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Http\Requests\UserRequest;
use App\Jobs\SendEmailCreatingUserAccountSuccessJob;
use App\Jobs\SendEmailVerificationAcceptJob;
use App\Models\Bidang;
use App\Models\Dinas;
use App\Models\Document;
use App\Models\Pegawai;
use App\Models\QrCodeLogo;
use App\Models\TempUser;
use App\Models\Tte;
use App\Models\User;
use App\Models\VerifikasiPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
  public function index()
  {
    $users = User::with('bidang', 'dinas')->get();

    return view('admin.user.user-index', compact('users'));
  }

  public function create()
  {
    $dinas = Dinas::all();

    return view('admin.user.user-create', compact('dinas'));
  }

  public function store(UserRequest $request)
  {
    $validated = $request->validated();
    // dd($validated);

    $identity_number = $validated['nik'];

    $is_verification_data_exist = VerifikasiPegawai::where('identity_number', $identity_number)
      ->where('status', VerifikasiPegawai::STATUS_WAITING)
      ->exists();
    if ($is_verification_data_exist) {
      $request->session()->flash('error', 'Data user ini menunggu proses verifikasi verifikasi!');
      return redirect()->route('admin.user.create');
    }

    if ($request->hasFile('ktp')) {
      $file_ktp = $request->file('ktp');
      $ktp = $file_ktp->store('documents/ktp');
    }

    if ($request->hasFile('sk_terakhir')) {
      $file_sk_terakhir = $request->file('sk_terakhir');
      $sk_terakhir = $file_sk_terakhir->store('documents/sk_terakhir');
    }

    $unique_code = HelperController::generateUniqueCode();

    $data = [
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'Nama Lengkap',
        'name' => 'nama',
        'value' => $validated['nama'],
        'status' => VerifikasiPegawai::STATUS_ACCEPTED,
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'Jenis Kelamin',
        'name' => 'jenis_kelamin',
        'value' => $validated['jenis_kelamin'],
        'status' => VerifikasiPegawai::STATUS_ACCEPTED,
      ],

      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'NIK',
        'name' => 'nik',
        'value' => $validated['nik'],
        'status' => VerifikasiPegawai::STATUS_ACCEPTED,
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'NIP',
        'name' => 'nip',
        'value' => $validated['nip'],
        'status' => VerifikasiPegawai::STATUS_ACCEPTED,
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'Email',
        'name' => 'email',
        'value' => $validated['email'],
        'status' => VerifikasiPegawai::STATUS_ACCEPTED,
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'No Telpon',
        'name' => 'no_telp',
        'value' => $validated['no_telp'],
        'status' => VerifikasiPegawai::STATUS_ACCEPTED
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'Tempat Lahir',
        'name' => 'tempat_lahir',
        'value' => $validated['tempat_lahir'],
        'status' => VerifikasiPegawai::STATUS_ACCEPTED
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'date',
        'label' => 'Tanggal Lahir',
        'name' => 'tanggal_lahir',
        'value' => $validated['tanggal_lahir'],
        'status' => VerifikasiPegawai::STATUS_ACCEPTED
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'Dinas',
        'name' => 'dinas_id',
        'value' => $validated['dinas_id'],
        'status' => VerifikasiPegawai::STATUS_ACCEPTED
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'Bidang',
        'name' => 'sub_bidang_id',
        'value' => $validated['sub_bidang_id'],
        'status' => VerifikasiPegawai::STATUS_ACCEPTED
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'Golongan',
        'name' => 'golongan',
        'value' => $validated['golongan'],
        'status' => VerifikasiPegawai::STATUS_ACCEPTED
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'Pangkat',
        'name' => 'pangkat',
        'value' => $validated['pangkat'],
        'status' => VerifikasiPegawai::STATUS_ACCEPTED
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'Password',
        'name' => 'password',
        'value' => '12345678',
        'status' => VerifikasiPegawai::STATUS_ACCEPTED
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'Password Confirmation',
        'name' => 'password_confirmation',
        'value' => '12345678',
        'status' => VerifikasiPegawai::STATUS_ACCEPTED
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'File KTP',
        'name' => 'file_ktp',
        'value' => $ktp,
        'status' => VerifikasiPegawai::STATUS_ACCEPTED
      ],
      [
        'identity_number' => $identity_number,
        'type' => 'string',
        'label' => 'File SK Terakhir',
        'name' => 'file_sk_terakhir',
        'value' => $sk_terakhir,
        'status' => VerifikasiPegawai::STATUS_ACCEPTED
      ]
    ];

    TempUser::create([
      'nama' => $validated['nama'],
      'jenis_kelamin' => $validated['jenis_kelamin'],
      'nik' => $validated['nik'],
      'nip' => $validated['nip'],
      'email' => $validated['email'],
      'password' => '12345678',
      'no_telp' => $validated['no_telp'],
      'tempat_lahir' => $validated['tempat_lahir'],
      'tanggal_lahir' => $validated['tanggal_lahir'],
      'dinas_id' => $validated['dinas_id'],
      'sub_bidang_id' => $validated['sub_bidang_id'],
      'golongan' => $validated['golongan'],
      'pangkat' => $validated['pangkat'],
      'role_id' => $validated['role'],
      'file_ktp' => $ktp,
      'file_sk_terakhir' => $sk_terakhir,
      'unique_code' => $unique_code
    ]);

    VerifikasiPegawai::insert($data);

    $user = User::insertGetId([
      'nama' => $validated['nama'],
      'email' => $validated['email'],
      'password' => Hash::make('12345678'),
      'unique_code' => $unique_code,
      'no_telp' => $validated['no_telp'],
      'dinas_id' => $validated['dinas_id'],
      'sub_bidang_id' => $validated['sub_bidang_id'],
      'role_id' => $validated['role'],
      'status' => User::STATUS_ACTIVE,
      'created_at' => now(),
      'updated_at' => now()
    ]);

    Pegawai::create([
      'user_id' => $user,
      'jenis_kelamin' => $validated['jenis_kelamin'],
      'tempat_lahir' => $validated['tempat_lahir'],
      'tanggal_lahir' => $validated['tanggal_lahir'],
      'nik' => $validated['nik'],
      'nip' => $validated['nip'],
      'golongan' => $validated['golongan'],
      'pangkat' => $validated['pangkat'],
      'created_at' => now(),
      'updated_at' => now()
    ]);

    $documents = [
      [
        'user_id' => $user,
        'jenis_dokumen' => 'KTP',
        'nama_file' => $ktp,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'user_id' => $user,
        'jenis_dokumen' => 'SK Terakhir',
        'nama_file' => $sk_terakhir,
        'created_at' => now(),
        'updated_at' => now()
      ]
    ];
    Document::insert($documents);

    dispatch(new SendEmailCreatingUserAccountSuccessJob($validated['email']));

    Session::flash('success', 'Data pegawai a.n ' . $validated['nama'] . ' berhasil ditambahkan.');
    return redirect()->route('admin.user.index');
  }

  public function show($id)
  {
    $user = User::with('pegawai', 'dinas', 'bidang')->findOrFail($id);

    return view('admin.user.user-detail', compact('user'));
  }

  public function edit($id)
  {
    $user = User::with('pegawai', 'dinas', 'bidang')->findOrFail($id);

    $dinas = Dinas::all();
    $bidang = Bidang::where('dinas_id', $user->dinas_id)->get();
    
    return view('admin.user.user-edit', compact('user', 'dinas', 'bidang'));
  }

  public function update(UserRequest $request, $id) {
    $validated = $request->validated();

    $user = User::findOrFail($id);
    $user->nama = $validated['nama'];
    $user->email = $validated['email'];
    $user->no_telp = $validated['no_telp'];
    $user->dinas_id = $validated['dinas_id'];
    $user->sub_bidang_id = $validated['sub_bidang_id'];
    $user->role_id = $validated['role'];
    $user->status = $request->status;
    $user->save();

    $pegawai = Pegawai::where('user_id', $id)->first();
    $pegawai->jenis_kelamin = $validated['jenis_kelamin'];
    $pegawai->tempat_lahir = $validated['tempat_lahir'];
    $pegawai->tanggal_lahir = $validated['tanggal_lahir'];
    $pegawai->nik = $validated['nik'];
    $pegawai->nip = $validated['nip'];
    $pegawai->pangkat = $validated['pangkat'];
    $pegawai->golongan = $validated['golongan'];
    $pegawai->save();

    Session::flash('success', 'Data pegawai a.n ' . $validated['nama'] . ' berhasil diperbarui.');
    return redirect()->route('admin.user.index');
  }

  public function destroy($id)
  {
    $user = User::findOrFail($id);

    $nama = $user->nama;

    $documents = Document::where('user_id', $id)->get();
    if ($documents) {
      foreach ($documents as $document) {
        Storage::delete($document->nama_file);
        $document->delete();
      }
    }

    $logo_qr_code = QrCodeLogo::where('user_id', $id)->first();
    if ($logo_qr_code) {
      Storage::delete($logo_qr_code->logo);
      $logo_qr_code->delete();
    }

    $temp_user = TempUser::where('email', $user->email)->first();
    if ($temp_user) {
      $temp_user->delete();
    }

    $tte = Tte::where('user_id', $id)->first();
    if ($tte) {
      Storage::delete($tte->qrcode);
      Storage::delete($tte->tte);
      $tte->delete();
    }

    $pegawai = Pegawai::where('user_id', $id)->first();
    if ($pegawai) {
      $pegawai->delete();
    }

    $user->delete();

    session()->flash('success', 'Data pegawai a.n ' . $nama . ' berhasil dihapus.');
    return redirect()->route('admin.user.index');
  }
}

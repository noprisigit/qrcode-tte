<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class UserRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    if (Route::currentRouteName() == 'admin.user.store') {
      return [
        'nik' => 'required|unique:pegawai',
        'nip' => 'required|unique:pegawai',
        'nama' => 'required',
        'email' => 'required|unique:users',
        'no_telp' => 'required',
        'jenis_kelamin' => 'required',
        'dinas_id' => 'required',
        'sub_bidang_id' => 'required',
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required',
        'pangkat' => 'required',
        'golongan' => 'required',
        'ktp' => 'required|max:2048',
        'sk_terakhir' => 'required|max:2048',
        'role' => 'required',
      ];
    } elseif (Route::currentRouteName() == 'admin.user.update') {
      return [
        'nik' => 'required',
        'nip' => 'required',
        'nama' => 'required',
        'email' => 'required|unique:users,email,' . $this->id,
        'no_telp' => 'required',
        'jenis_kelamin' => 'required',
        'dinas_id' => 'required',
        'sub_bidang_id' => 'required',
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required',
        'pangkat' => 'required',
        'golongan' => 'required',
        'role' => 'required',
      ];
    }
  }

  public function attributes()
  {
    return [
      'nik' => 'NIK',
      'nip' => 'NIP',
      'nama' => 'Nama',
      'email' => 'Email',
      'no_telp' => 'Nomor telpon',
      'jenis_kelamin' => 'Jenis kelamin',
      'dinas_id' => 'Dinas',
      'sub_bidang_id' => 'Bidang',
      'tempat_lahir' => 'Tempat lahir',
      'tanggal_lahir' => 'Tanggal lahir',
      'pangkat' => 'Pangkat',
      'golongan' => 'Golongan',
      'ktp' => 'KTP',
      'sk_terakhir' => 'SK terakhir',
      'role' => 'Hak akses'
    ];
  }
}

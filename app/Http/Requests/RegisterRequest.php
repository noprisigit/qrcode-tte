<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
    return [
      'nama' => 'required|string|max:255',
      'jenis_kelamin' => 'required',
      'nik' => 'required|max:255',
      'nip' => 'required|max:255',
      'email' => 'required|email:dns|max:255|unique:temp_users',
      'no_telp' => 'required',
      'tempat_lahir' => 'required|string|max:255',
      'tanggal_lahir' => 'required|date',
      'dinas_id' => 'required',
      'sub_bidang_id' => 'required',
      'golongan' => 'required|string|max:255',
      'pangkat' => 'required|string|max:255',
      'password' => 'required',
      'password_confirmation' => 'required|same:password',
      'ktp' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
      'sk_terakhir' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
    ];
  }

  public function attributes()
  {
    return [
      'nama' => 'Nama lengkap',
      'jenis_kelamin' => 'Jenis kelamin',
      'nik' => 'NIK',
      'nip' => 'NIP',
      'email' => 'Email',
      'no_telp' => 'No. telepon',
      'tempat_lahir' => 'Tempat lahir',
      'tanggal_lahir' => 'Tanggal lahir',
      'dinas_id' => 'Dinas',
      'sub_bidang_id' => 'Bidang',
      'golongan' => 'Golongan',
      'pangkat' => 'Pangkat',
      'password' => 'Kata sandi',
      'password_confirmation' => 'Konfirmasi kata sandi',
      'ktp' => 'KTP',
      'sk_terakhir' => 'SK Terakhir',
    ];
  }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateProfileRequest extends FormRequest
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
      'nik' => 'required|min:16',
      'nip' => 'required',
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users,email,' . $this->user()->id,
      'phone' => 'required|string|max:255',
      'gender' => 'required',
      'pob' => 'required|string|max:255',
      'dob' => 'required',
      'pangkat' => 'required',
      'golongan' => 'required',
    ];
  }

  public function attributes()
  {
    return [
      'nik' => 'NIK',
      'nip' => 'NIP',
      'name' => 'Nama',
      'email' => 'Email',
      'phone' => 'No. Telepon',
      'gender' => 'Jenis kelamin',
      'pob' => 'Tempat lahir',
      'dob' => 'Tanggal lahir',
      'pangkat' => 'Pangkat',
      'golongan' => 'Golongan',
    ];
  }
}

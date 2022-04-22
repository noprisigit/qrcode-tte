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
      'dinas_id' => 'required',
      'sub_bidang_id' => 'required',
      'pob' => 'required|string|max:255',
      'dob' => 'required',
      'pangkat' => 'required',
      'tmt_pangkat' => 'required',
      'golongan' => 'required',
      'tmt_golongan' => 'required',
      'tgl_awal_pengangkatan' => 'required',
      'status_kepegawaian' => 'required',
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
      'dinas_id' => 'Dinas',
      'sub_bidang_id' => 'Bidang',
      'pob' => 'Tempat lahir',
      'dob' => 'Tanggal lahir',
      'pangkat' => 'Pangkat',
      'tmt_pangkat' => 'TMT pangkat',
      'golongan' => 'Golongan',
      'tmt_golongan' => 'TMT golongan',
      'tgl_awal_pengangkatan' => 'Tanggal awal pengangkatan',
      'status_kepegawaian' => 'Status kepegawaian',
    ];
  }
}

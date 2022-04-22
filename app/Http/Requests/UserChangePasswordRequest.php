<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserChangePasswordRequest extends FormRequest
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
      'old_password' => 'required',
      'new_password' => 'required|min:6',
      'new_password_confirmation' => 'required|same:new_password',
    ];
  }

  public function attributes()
  {
    return [
      'old_password' => 'Kata sandi lama',
      'new_password' => 'Kata sandi baru',
      'new_password_confirmation' => 'Konfirmasi kata sandi baru',
    ];
  }
}

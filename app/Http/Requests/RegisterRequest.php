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
      'name' => 'required|string|max:255',
      'email' => 'required|email:dns|max:255|unique:users',
      'password' => 'required',
      'password_confirmation' => 'required|same:password',
    ];
  }

  public function attributes()
  {
    return [
      'name' => 'Nama lengkap',
      'email' => 'Email',
      'password' => 'Kata sandi',
      'password_confirmation' => 'Konfirmasi kata sandi'
    ];
  }
}

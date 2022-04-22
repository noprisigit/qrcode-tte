<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DinasRequest extends FormRequest
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
    ];
  }

  public function attributes()
  {
    return [
      'nama' => 'Nama dinas',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.*
   * 
   * @return array
   */
  protected function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(response()->json([
      'errors' => $validator->errors(),
      'status' => true
    ], 400));
  }
}

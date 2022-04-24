<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class GenerateQrCodeRequest extends FormRequest
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
      'size' => ''
    ];
  }

  public function attributes()
  {
    return [
      'size' => 'Ukuran QR Code'
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

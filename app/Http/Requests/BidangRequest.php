<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BidangRequest extends FormRequest
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
          'dinas_id' => 'required',
          'nama' => 'required|string|max:255',
        ];
    }

    public function attributes()
    {
      return [
        'dinas_id' => 'Dinas',
        'nama' => 'Nama bidang',
      ];
    }
}

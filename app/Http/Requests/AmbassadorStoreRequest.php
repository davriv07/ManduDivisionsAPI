<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AmbassadorStoreRequest extends FormRequest
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
  public function rules(): array
  {
    if (request()->isMethod('post')) {
      return [
        'name' => 'required|string|min:2|max:100|unique:ambassadors,name'
      ];
    }
    return [
      'name' => 'required|string'
    ];
  }

  public function messages()
  {
    if (request()->isMethod('post')) {
      return [
        'name.required' => 'Name is required!'
      ];
    }
    return [
      'name.required' => 'Name is required!'
    ];
  }
}

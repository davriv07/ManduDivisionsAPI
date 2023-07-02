<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubdivisionStoreRequest extends FormRequest
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
    if (request()->isMethod('post')) {
      return [
        'id_division_parent' => 'required|integer|exists:divisions,id',
        'id_division_sub' => 'required|integer|exists:divisions,id',
      ];
    }
    return [
      'id_division_parent' => 'required|integer',
      'id_division_sub' => 'required|integer',
    ];
  }

  public function messages()
  {
    if (request()->isMethod('post')) {
      return [
        'id_division_parent.required' => 'Parent division needed!',
        'id_division_parent.integer' => 'Parent division must be an integer!',
        'id_division_parent.exists:divisions,id' => 'Parent division must exists!',
        'id_division_sub.required' => 'Child division needed!',
        'id_division_sub.integer' => 'Child division must be an integer!',
        'id_division_sub.exists:divisions,id' => 'Child division must exists!',
      ];
    }
    return [
      'id_division_parent.required' => 'Parent division needed!',
      'id_division_parent.integer' => 'Parent division must be an integer!',
      'id_division_parent.exists:divisions,id' => 'Parent division must exists!',
      'id_division_sub.required' => 'Child division needed!',
      'id_division_sub.integer' => 'Child division must be an integer!',
      'id_division_sub.exists:divisions,id' => 'Child division must exists!',
    ];
  }
}

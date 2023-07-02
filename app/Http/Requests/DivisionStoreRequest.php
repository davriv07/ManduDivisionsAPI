<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DivisionStoreRequest extends FormRequest
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
        'division' => 'required|string|min:2|max:45|unique:divisions,division',
        'division_parent' => 'integer|exists:divisions,id',
        'collaborators' => 'integer|min:0',
        'id_ambassador' => 'integer|exists:ambassadors,id',
      ];
    }
    return [
      'division' => 'required|string',
      'division_parent' => 'integer',
      'collaborators' => 'integer',
      'id_ambassador' => 'integer',
    ];
  }

  public function messages()
  {
    if (request()->isMethod('post')) {
      return [
        'division.required' => 'Name of division is required!',
        'division.string' => 'Division name must be a string.',
        'division.max:45' => 'Division can not be bigger than 45 characters.',
        'division.unique:divisions,division' => 'Division name already taken.',
        'division_parent.integer' => 'Division parent must be an integer.',
        'division_parent.exists:division,id' => 'Division parent must be an id of an existing division.',
        'id_ambassador.integer' => 'Ambassador must be an integer.',
        'id_ambassador.exists:ambassadors,id' => 'Ambassador must be an existing Ambassdador.',
      ];
    }
    return [
      'division.required' => 'Name of division is required!',
      'division.string' => 'Division name must be a string.',
      'division.max:45' => 'Division can not be bigger than 45 characters.',
      'division.unique:divisions,division' => 'Division name already taken.',
      'division_parent.integer' => 'Division parent must be an integer.',
      'division_parent.exists:division,id' => 'Division parent must be an id of an existing division.',
      'id_ambassador.integer' => 'Ambassador must be an integer.',
      'id_ambassador.exists:ambassadors,id' => 'Ambassador must be an existing Ambassdador.',
    ];
  }

}

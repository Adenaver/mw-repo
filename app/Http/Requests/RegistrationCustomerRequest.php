<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationCustomerRequest extends FormRequest
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
            'name' => 'required|min:5|max:100',
            'surname' => 'required|min:5|max:100',
            'email' => 'required|string|min:4|max:40|unique:users|unique:sellers',
            'password' => 'required',
            'password_repeat' => 'required'
        ];
    }
}

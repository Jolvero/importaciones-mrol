<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;


class UserRequest extends FormRequest
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
            //
            'name' => 'required|max:30',
            'username' => 'required|unique:users|max:20',
            'email' => 'required|unique:users|max:60',
            'rol_id' => 'required',
            'cliente_id' => 'nullable',
            'password' => 'required|confirmed|min:6|'
        ];
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 3/17/2019
 * Time: 2:25 PM
 */

namespace App\Http\Request\User;

use Illuminate\Http\Request;

class RegisterUserRequest extends Request
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
            'email' => 'required|unique:users',
            'password' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'El usuario es requerido',
            'password.required'  => 'El password es requerido',
            'email.unique'   => 'El email debe ser único'
        ];
    }

}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //'email' => 'required|email',
            'run' => 'required|string',
            'password' => 'required|string|min:6',
        ];
    }

    public function failedValidation(Validator $validator)
    {
       throw new HttpResponseException(response()->json([
         'errors'      => $validator->errors()
       ]));
    }

    public function messages()
    {
        return [
            //'email.required' => 'El correo electrónico es obligatorio.',
            //'email.email' => 'El formato del correo electrónico es inválido.',
            'rut.required' => 'El RUT es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
        ];
    }

}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthenticationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'nullable|email|required_without_all:phone,username',
            'phone' => 'nullable|required_without_all:email,username',
            'username' => 'nullable|required_without_all:email,phone',
            'password' => 'required|string|min:8',
        ];
    }
}

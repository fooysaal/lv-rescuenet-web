<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // validate from one of the following is required email, phone or username
            'name' => 'required|string|max:255',
            'email' => 'required_without:phone,username|email|unique:users,email',
            'phone' => 'required_without:email,username|unique:users,phone',
            'username' => 'required_without:email,phone|unique:users,username',
            'password' => 'required|string|min:8',
            'gender' => 'required|in:male,female,other',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}

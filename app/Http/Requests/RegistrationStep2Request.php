<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationStep2Request extends FormRequest
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
            'user_id' => ['required', 'exists:users,id'],
            'registration_token' => ['required', 'string'],
            'nid_front_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
            'nid_back_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
            'selfie_with_nid_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
        ];
    }

    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            'user_id.required' => 'User ID is required',
            'user_id.exists' => 'User not found',
            'registration_token.required' => 'Registration token is required',
            'nid_front_image.image' => 'NID front must be an image',
            'nid_front_image.mimes' => 'NID front must be jpeg, png, or jpg',
            'nid_front_image.max' => 'NID front image must not exceed 5MB',
            'nid_back_image.image' => 'NID back must be an image',
            'nid_back_image.mimes' => 'NID back must be jpeg, png, or jpg',
            'nid_back_image.max' => 'NID back image must not exceed 5MB',
            'selfie_with_nid_image.image' => 'Selfie must be an image',
            'selfie_with_nid_image.mimes' => 'Selfie must be jpeg, png, or jpg',
            'selfie_with_nid_image.max' => 'Selfie image must not exceed 5MB',
        ];
    }
}

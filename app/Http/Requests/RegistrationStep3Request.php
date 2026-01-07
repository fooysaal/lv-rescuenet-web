<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationStep3Request extends FormRequest
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
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'location' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'relationship' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15'],
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
            'latitude.required' => 'Latitude is required',
            'latitude.numeric' => 'Latitude must be a number',
            'latitude.between' => 'Latitude must be between -90 and 90',
            'longitude.required' => 'Longitude is required',
            'longitude.numeric' => 'Longitude must be a number',
            'longitude.between' => 'Longitude must be between -180 and 180',
            'location.max' => 'Location name must not exceed 255 characters',
            'name.required' => 'Emergency contact name is required',
            'name.max' => 'Emergency contact name must not exceed 255 characters',
            'relationship.required' => 'Relationship is required',
            'relationship.max' => 'Relationship must not exceed 255 characters',
            'phone.required' => 'Emergency contact phone number is required',
            'phone.max' => 'Emergency contact phone number must not exceed 15 characters',
        ];
    }
}

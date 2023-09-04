<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $this->user->id,
            'password' => 'nullable|string|min:8',
            'national_id' => 'nullable|string|unique:users,national_id,' . $this->user->id,
            'phone' => 'nullable|string|unique:users,phone,' . $this->user->id,
            'address' => 'nullable|string',
            'role' => 'nullable|string|in:admin,pharmacy,doctor,user',
            'supervisor_id' => 'nullable|exists:users,id',
        ];
        
    }
}

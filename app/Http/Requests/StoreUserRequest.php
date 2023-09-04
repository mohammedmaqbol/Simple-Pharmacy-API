<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name'          => 'required|string|max:255',
            'email'         => 'nullable|email|unique:users,email',
            'password'      => 'required|string|min:8',
            'national_id'   => 'required|string|unique:users,national_id',
            'phone'         => 'required|string|unique:users,phone',
            'address'       => 'required|string',
            'role'          => 'required|string|in:admin,pharmacy,doctor,user',
            'supervisor_id' => 'nullable|exists:users,id',
            'avatar'        => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}

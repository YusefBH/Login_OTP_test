<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:255',
            'last_name' => 'required|string|min:2|max:255',
            'national_code' => 'required|int|unique:users,national_code|regex:/^[\d]{10}$/',
            'password' => 'required|string|confirmed:confirm_password|min:8',
        ];
    }
}

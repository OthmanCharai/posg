<?php

namespace App\Http\Requests;

use App\src\Models\User\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            User::EMAIL_COLUMN    => ['required', 'string', 'email'],
            User::PASSWORD_COLUMN => ['required', 'confirmed', Password::min(8)],
        ];
    }
}

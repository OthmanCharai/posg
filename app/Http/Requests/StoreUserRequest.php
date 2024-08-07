<?php

namespace App\Http\Requests;

use App\src\Models\AdminRole\AdminRole;
use App\src\Models\Depot\Depot;
use App\src\Models\User\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            User::EMAIL_COLUMN        => ['required', 'email', Rule::unique(User::TABLE_NAME)],
            User::FIRST_NAME_COLUMN   => ['required', 'string', 'max:255'],
            User::LAST_NAME_COLUMN    => ['required', 'string', 'max:255'],
            User::ADDRESS_COLUMN      => ['nullable', 'string', 'max:255'],
            User::PHONE_NUMBER_COLUMN => ['nullable', 'string', 'max:255'],
            User::PASSWORD_COLUMN     => [
                'required',
                Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised(),
            ],
            User::ROLE_ID_COLUMN      => [
                'required',
                'string',
                sprintf('exists:%s,%s', AdminRole::TABLE_NAME, AdminRole::ID_COLUMN),
            ],
            User::LOGO_COLUMN         => [
                'nullable',
                'image',
            ],
            User::DEPOT_ID_COLUMN     => ['nullable', Rule::exists(Depot::TABLE_NAME, Depot::ID_COLUMN)],
        ];
    }
}

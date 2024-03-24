<?php

namespace App\Http\Requests;

use App\src\Models\CompanySetting\CompanySetting;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanySettingRequest extends FormRequest
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
            CompanySetting::EMAIL_COLUMN           => ['nullable', 'string', 'max:255'],
            CompanySetting::ADDRESS_COLUMN         => ['nullable', 'string', 'max:255'],
            CompanySetting::NAME_COLUMN            => ['nullable', 'string', 'max:255'],
            CompanySetting::CAPITAL_COLUMN         => ['nullable', 'numeric'],
            CompanySetting::NUM_BGFI_COLUMN        => ['nullable', 'numeric'],
            CompanySetting::NUM_NIF_COLUMN         => ['nullable', 'numeric'],
            CompanySetting::NUM_RC_COLUMN          => ['nullable', 'numeric'],
            CompanySetting::NUM_STATISTIQUE_COLUMN => ['nullable', 'numeric'],
            CompanySetting::WEBSITE_COLUMN         => ['nullable', 'string', 'max:255'],
            CompanySetting::NUM_UGB_COLUMN         => ['nullable', 'numeric'],
            CompanySetting::PHONE_COLUMN           => ['nullable', 'numeric'],
            CompanySetting::RETURN_POLICY_COLUMN   => ['nullable', 'string', 'max:255'],
            CompanySetting::PATH_COLUMN            => ['nullable', 'image'],
        ];
    }
}

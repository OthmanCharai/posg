<?php

namespace App\Http\Requests;

use App\src\Models\CompanySetting\CompanySetting;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCompanySettingRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            CompanySetting::EMAIL_COLUMN           => ['required', 'string', 'max:255'],
            CompanySetting::ADDRESS_COLUMN         => ['required', 'string', 'max:255'],
            CompanySetting::NAME_COLUMN            => ['required', 'string', 'max:255'],
            CompanySetting::CAPITAL_COLUMN         => ['required', 'numeric'],
            CompanySetting::NUM_BGFI_COLUMN        => ['required', 'numeric'],
            CompanySetting::NUM_NIF_COLUMN         => ['required', 'numeric'],
            CompanySetting::NUM_RC_COLUMN          => ['required', 'numeric'],
            CompanySetting::NUM_STATISTIQUE_COLUMN => ['required', 'numeric'],
            CompanySetting::WEBSITE_COLUMN         => ['nullable', 'string', 'max:255'],
            CompanySetting::NUM_UGB_COLUMN         => ['required', 'numeric'],
            CompanySetting::PHONE_COLUMN           => ['required', 'numeric'],
            CompanySetting::RETURN_POLICY_COLUMN   => ['required', 'string', 'max:255'],
            CompanySetting::PATH_COLUMN            => ['required', 'image']
        ];
    }
}

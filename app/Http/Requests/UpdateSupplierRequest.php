<?php

namespace App\Http\Requests;

use App\src\Models\Supplier\Supplier;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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
            Supplier::EMAIL_COLUMN          => ['nullable', 'email'],
            Supplier::PHONE_NUMBER_COLUMN   => ['nullable', 'string', 'max:255'],
            Supplier::FIRST_NAME_COLUMN     => ['nullable', 'string', 'max:255'],
            Supplier::LAST_NAME_COLUMN      => ['nullable', 'string', 'max:255'],
            Supplier::ACCOUNT_NUMBER_COLUMN => ['nullable', 'string', 'max:255'],
            Supplier::VAT_NUMBER_COLUMN     => ['nullable', 'string', 'max:255'],
            Supplier::COMPANY_NAME_COLUMN   => ['nullable', 'string', 'max:255'],
            Supplier::ADDRESS_COLUMN        => ['nullable', 'string', 'max:255'],
        ];
    }
}

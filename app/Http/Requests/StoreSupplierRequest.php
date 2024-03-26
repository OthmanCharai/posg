<?php

namespace App\Http\Requests;

use App\src\Models\Supplier\Supplier;
use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            Supplier::ID_COLUMN             => ['required', 'integer'],
            Supplier::EMAIL_COLUMN          => ['required', 'email'],
            Supplier::PHONE_NUMBER_COLUMN   => ['required', 'string', 'max:255'],
            Supplier::FIRST_NAME_COLUMN     => ['required', 'string', 'max:255'],
            Supplier::LAST_NAME_COLUMN      => ['required', 'string', 'max:255'],
            Supplier::ACCOUNT_NUMBER_COLUMN => ['required', 'string', 'max:255'],
            Supplier::VAT_NUMBER_COLUMN     => ['required', 'string', 'max:255'],
            Supplier::COMPANY_NAME_COLUMN   => ['required', 'string', 'max:255'],
            Supplier::ADDRESS_COLUMN        => ['required', 'string', 'max:255'],
        ];
    }
}

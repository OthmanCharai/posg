<?php

namespace App\Http\Requests;

use App\src\Models\BankAccount\BankAccount;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBankAccountRequest extends FormRequest
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
            BankAccount::BANK_NAME_COLUMN            => 'required|string|max:255',
            BankAccount::ACCOUNT_NUMBER_COLUMN       => 'required|string|max:255',
            BankAccount::BALANCE_COLUMN              => 'required|numeric|min:0',
            BankAccount::ACCOUNT_HOLDER_NAME_COLUMN  => 'required|string|max:255',
            BankAccount::ACCOUNT_HOLDER_PHONE_COLUMN => 'required|string|max:255',
            BankAccount::ACCOUNT_HOLDER_EMAIL_COLUMN => 'required|email|max:255',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\src\Models\TaxVariant\Enums\TaxVariantTypeEnum;
use App\src\Models\TaxVariant\TaxVariant;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaxVariantRequest extends FormRequest
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
            TaxVariant::NAME_COLUMN  => ['required', 'string', 'max:255'],
            TaxVariant::VALUE_COLUMN => ['required', 'numeric'],
            TaxVariant::TYPE_COLUMN  => ['required', 'numeric', Rule::in(TaxVariantTypeEnum::cases())],
        ];
    }
}

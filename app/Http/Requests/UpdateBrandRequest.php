<?php

namespace App\Http\Requests;

use App\src\Models\Brands\Brand;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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
            Brand::NAME_COLUMN         => ['required', 'string', 'max:255'],
            Brand::ABBREVIATION_COLUMN => ['nullable', 'string', 'max:255'],
            Brand::LOGO_COLUMN         => ['nullable', 'image'],
        ];
    }
}

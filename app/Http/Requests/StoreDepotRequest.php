<?php

namespace App\Http\Requests;

use App\src\Models\Depot\Depot;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDepotRequest extends FormRequest
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
            Depot::NAME_COLUMN    => ['required', 'string', 'max:255'],
            Depot::ADDRESS_COLUMN => ['required', 'string'],
        ];
    }
}

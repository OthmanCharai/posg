<?php

namespace App\Http\Requests;

use App\src\Models\Depot\Depot;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SyncArticleDepotRequest extends FormRequest
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
            'depots'            => ['required', 'array'],
            'depots.*.id'       => ['required', Rule::exists(Depot::TABLE_NAME, Depot::ID_COLUMN)],
            'depots.*.quantity' => ['required', 'numeric'],
        ];
    }
}

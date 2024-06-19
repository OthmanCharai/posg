<?php

namespace App\Http\Requests;

use App\src\Models\User\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserLogRequest extends FormRequest
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
            'user_id'    => ['required', Rule::exists(User::TABLE_NAME, User::ID_COLUMN), 'max:255'],
            'table_name' => ['required', 'string', 'max:255'],
            'log_type'   => ['required', 'string', 'max:255'],
        ];
    }
}

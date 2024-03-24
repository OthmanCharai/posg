<?php

namespace App\Http\Requests;

use App\src\Models\AdminRole\AdminRole;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRoleRequest extends FormRequest
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
            AdminRole::NAME_COLUMN               => ['required', 'string', 'max:255'],
            AdminRole::DESCRIPTION_COLUMN        => ['required', 'string', 'max:255'],
            AdminRole::PERMISSIONS_COLUMN        => ['required', 'array'],
            AdminRole::PERMISSIONS_COLUMN . ".*" => ['required', 'numeric'],
        ];
    }
}

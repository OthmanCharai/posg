<?php

namespace App\Http\Requests;

use App\src\Models\Article\Article;
use App\src\Models\Article\Enums\ArticleStockTypeEnum;
use App\src\Models\ArticleCategory\ArticleCategory;
use App\src\Models\Compatibility\Compatibility;
use App\src\Models\Depot\Depot;
use App\src\Models\Supplier\Supplier;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreArticleRequest extends FormRequest
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
            Article::BARCODE_COLUMN         => ['required', 'unique'],
            Article::NAME_COLUMN            => ['required', 'string', 'max:255'],
            Article::STOCK_TYPE_COLUMN      => [
                'required',
                'number',
                'in:' . implode(',', array_column(ArticleStockTypeEnum::cases(), 'value')),
            ],
            Article::SUPPLIER_ID_COLUMN     => [
                'required',
                'string',
                Rule::exists(Supplier::TABLE_NAME, Supplier::ID_COLUMN),
            ],
            Article::CATEGORY_ID_COLUMN     => [
                'required',
                'string',
                Rule::exists(ArticleCategory::TABLE_NAME, ArticleCategory::ID_COLUMN),
            ],
            Article::IMAGE_COLUMN           => ['required', 'image'],
            Article::PURCHASE_PRICE_COLUMN  => ['required', 'numeric'],
            Article::LAST_SALE_PRICE_COLUMN => ['required', 'numeric'],
            Article::RETAIL_PRICE_COLUMN    => ['required', 'numeric'],
            Article::WHOLESALE_PRICE_COLUMN => ['required', 'numeric'],
            Article::DESCRIPTION_COLUMN     => ['required', 'string'],
            Article::LOCATION_COLUMN        => ['required', 'string', 'max:255'],
            'depots'                        => ['required', 'array'],
            'depots.*.id'                   => ['required', Rule::exists(Depot::TABLE_NAME, Depot::ID_COLUMN)],
            'depots.*.quantity'             => ['required', 'numeric'],
            'compatibilities'               => ['required', 'array'],
            'compatibilities.*'             => [
                'required',
                Rule::exists(Compatibility::class, Compatibility::ID_COLUMN),
            ],
        ];
    }
}

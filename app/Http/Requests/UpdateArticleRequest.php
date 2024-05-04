<?php

namespace App\Http\Requests;

use App\src\Models\Article\Article;
use App\src\Models\Article\Enums\ArticleStockTypeEnum;
use App\src\Models\ArticleCategory\ArticleCategory;
use App\src\Models\Compatibility\Compatibility;
use App\src\Models\Supplier\Supplier;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateArticleRequest extends FormRequest
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
            Article::BARCODE_COLUMN         => [
                'required',
                Rule::unique(Article::TABLE_NAME, Article::BARCODE_COLUMN)->ignore(
                    $this->article->id,
                    Article::ID_COLUMN
                ),
            ],
            Article::NAME_COLUMN            => ['required', 'string', 'max:255'],
            Article::STOCK_TYPE_COLUMN      => [
                'required',
                'numeric',
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
            Article::IMAGE_COLUMN           => ['nullable', 'image'],
            Article::PURCHASE_PRICE_COLUMN  => ['required', 'numeric'],
            Article::LAST_SALE_PRICE_COLUMN => ['required', 'numeric'],
            Article::RETAIL_PRICE_COLUMN    => ['required', 'numeric'],
            Article::WHOLESALE_PRICE_COLUMN => ['required', 'numeric'],
            Article::DESCRIPTION_COLUMN     => ['required', 'string'],
            Article::LOCATION_COLUMN        => ['required', 'string', 'max:255'],
            'compatibilities'               => ['required', 'array'],
            'compatibilities.*'             => [
                'required',
                Rule::exists(Compatibility::class, Compatibility::ID_COLUMN),
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            [
                Article::PURCHASE_PRICE_COLUMN  => (int)$this->getInputSource()?->get(
                        Article::PURCHASE_PRICE_COLUMN
                    ) * 100,
                Article::LAST_SALE_PRICE_COLUMN => (int)$this->getInputSource()?->get(
                        Article::LAST_SALE_PRICE_COLUMN
                    ) * 100,
                Article::RETAIL_PRICE_COLUMN    => (int)$this->getInputSource()?->get(
                        Article::RETAIL_PRICE_COLUMN
                    ) * 100,
                Article::WHOLESALE_PRICE_COLUMN => (int)$this->getInputSource()?->get(
                        Article::WHOLESALE_PRICE_COLUMN
                    ) * 100,
            ]
        );
    }
}

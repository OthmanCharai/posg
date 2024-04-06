<?php

use App\src\Models\ArticleCategory\ArticleCategory;
use App\src\Models\Brands\Brand;
use App\src\Models\Supplier\Supplier;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', static function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('code_bare')->unique();
            $table->string('name');
            $table->string('emplacement');
            $table->unsignedInteger('purchase_price');
            $table->unsignedInteger('wholesale_price');
            $table->unsignedInteger('retail_price');
            $table->unsignedInteger('last_sale_price');
            $table->tinyInteger('stock_type');
            $table->text('description');
            $table->string('image');
            $table->string('brand_id');
            $table->string('article_category_id');
            $table->string('supplier_id');
            $table->foreign('brand_id')->references(Brand::TABLE_NAME)->on(
                Brand::ID_COLUMN
            )->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('article_category_id')->references(
                ArticleCategory::TABLE_NAME
            )
                ->on(ArticleCategory::ID_COLUMN)->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('supplier_id')->references(Supplier::TABLE_NAME)->on(
                Supplier::ID_COLUMN
            )
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', static function (Blueprint $table) {
            $table->dropForeign(['brand_id', 'article_category_id', 'supplier_id']);
        });
        Schema::dropIfExists('articles');
    }
};

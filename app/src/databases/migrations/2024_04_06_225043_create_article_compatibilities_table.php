<?php

use App\src\Models\Article\Article;
use App\src\Models\Compatibility\Compatibility;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article_compatibilities', static function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('article_id');
            $table->string('compatibility_id');

            $table->foreign('article_id')->references(Article::ID_COLUMN)->on(
                Article::TABLE_NAME
            )->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('compatibility_id')->references(Compatibility::ID_COLUMN)
                ->on(Compatibility::TABLE_NAME)
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('article_compatibilities', static function (Blueprint $table) {
            $table->dropForeign(['compatibility_id', 'article_id']);
        });

        Schema::dropIfExists('article_compatibilities');
    }
};

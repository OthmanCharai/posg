<?php

use App\src\Models\Article\Article;
use App\src\Models\Depot\Depot;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article_depots', static function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('article_id');
            $table->string('depot_id');
            $table->integer('quantity');

            $table->foreign('article_id')->references(Article::ID_COLUMN)->on(
                Article::TABLE_NAME
            )->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('depot_id')->references(Depot::ID_COLUMN)->on(
                Depot::TABLE_NAME
            )->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('article_depots', static function (Blueprint $table) {
            $table->dropForeign(['depot_id', 'article_id']);
        });
        Schema::dropIfExists('article_depots');
    }
};

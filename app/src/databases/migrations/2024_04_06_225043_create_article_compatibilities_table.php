<?php

use App\src\Models\Article\Article;
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
            $table->foreign('article_id')->references(Article::class)->on(
                Article::ID_COLUMN
            )->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign()->
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_compatibilities');
    }
};

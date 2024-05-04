<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article_iso', static function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('article_id');
            $table->string('value');
            $table->foreign('article_id')
                ->references('id')
                ->on('articles')
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
        Schema::table('article_iso', static function (Blueprint $table) {
            $table->dropForeign(['article_id']);
        });

        Schema::dropIfExists('article_iso');
    }
};

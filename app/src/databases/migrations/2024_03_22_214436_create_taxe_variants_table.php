<?php

use App\src\Models\Tax\Tax;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tax_variants', static function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('tax_id');
            $table->foreign('tax_id')->references(Tax::ID_COLUMN)
                ->on(
                    Tax::TABLE_NAME
                )->onDelete('cascade');
            $table->string('name');
            $table->decimal('value');
            $table->tinyInteger('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_variants');
    }
};

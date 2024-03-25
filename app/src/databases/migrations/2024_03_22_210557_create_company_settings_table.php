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
        Schema::create('company_settings', static function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('path');
            $table->string('phone');
            $table->string('email');
            $table->string('website')->nullable();
            $table->text('address');
            $table->bigInteger('capital');
            $table->string('num_rc');
            $table->string('num_nif');
            $table->string('num_statistique');
            $table->string('num_bgfi');
            $table->string('num_ugb');
            $table->text('return_policy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
};

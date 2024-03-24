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
        Schema::create('bank_accounts', static function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('bank_name');
            $table->string('account_number');
            $table->decimal('balance', 20, 2);
            $table->string('account_holder_name');
            $table->string('account_holder_phone');
            $table->string('account_holder_email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};

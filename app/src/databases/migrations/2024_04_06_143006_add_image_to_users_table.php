<?php

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
        Schema::table('users', static function (Blueprint $table) {
            $table->string('logo')->nullable();
            $table->string('depot_id')->nullable();
            $table->foreign('depot_id')->references(Depot::ID_COLUMN)->on(
                Depot::TABLE_NAME
            )
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('logo');
            $table->dropForeign('users_depot_id_foreign');
        });
    }
};

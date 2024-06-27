<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('menu_options', function (Blueprint $table) {
            $table->boolean('is_system_option')->default(false)->after('num_opcion');
            $table->boolean('executes_system_process')->default(false)->after('is_system_option');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_options', function (Blueprint $table) {
            $table->dropColumn('is_system_option');
            $table->dropColumn('executes_system_process');
        });
    }
};

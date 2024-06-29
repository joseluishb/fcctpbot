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
            $table->boolean('requires_response')->default(false)->after('acronym_esc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_options', function (Blueprint $table) {
            $table->dropColumn('requires_response');
        });
    }
};

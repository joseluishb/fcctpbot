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
        Schema::table('bot_sessions', function (Blueprint $table) {
            $table->string('device')->nullable();
            $table->string('browser')->nullable();
            $table->string('browser_version')->nullable();
            $table->string('platform')->nullable();
            $table->string('platform_version')->nullable();
            $table->string('ip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bot_sessions', function (Blueprint $table) {
            $table->dropColumn('device');
            $table->dropColumn('browser');
            $table->dropColumn('browser_version');
            $table->dropColumn('platform');
            $table->dropColumn('platform_version');
            $table->dropColumn('ip');

        });
    }
};

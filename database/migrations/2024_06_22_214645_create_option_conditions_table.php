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
        Schema::create('option_conditions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_option_id')->nullable();
            $table->json('condiciones')->nullable();
            $table->foreign('menu_option_id')->references('id')->on('menu_options')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_conditions');
    }
};

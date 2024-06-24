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
        Schema::create('menu_options', function (Blueprint $table) {
            $table->id();
            $table->integer('nivel')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->char('id_proceso', 50)->nullable();
            $table->string('desc_opcion', 255);
            $table->text('respuesta')->nullable();
            $table->integer('num_opcion')->nullable();
            $table->foreign('parent_id')->references('id')->on('menu_options')->onDelete('cascade');
            $table->integer('menu_nivel_volver')->nullable();
            $table->boolean('ind_volver')->default(true)->nullable();
            $table->boolean('ind_fin')->default(true)->nullable();
            $table->boolean('active')->default(true);
            $table->text('proceso')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_options');
    }
};

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
            $table->unsignedBigInteger('menu_option_id')->nullable();
            $table->string('descripcion', 255);
            $table->enum('tipo_accion', ['menu', 'informacion']);
            $table->text('contenido')->nullable();
            $table->char('codper', 8);
            $table->foreign('menu_option_id')->references('id')->on('menu_options')->onDelete('cascade');
            $table->boolean('active')->default(true);
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

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
        Schema::create('bot_interactions', function (Blueprint $table) {
            $table->id();
            $table->string('bot_session_id');
            $table->string('session_id');
            $table->uuid('uuid');
            $table->string('doc_number')->nullable();
            $table->string('interaction_type'); // "typed", "option_selected"
            $table->integer('option_selected')->nullable();
            $table->integer('option_parent')->nullable();
            $table->text('response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bot_interactions');
    }
};

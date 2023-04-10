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
        Schema::create('remarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('learn_outcome_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->text('content');
            $table->timestamps();

            $table->unique(['registration_id', 'learn_outcome_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remarks');
    }
};

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
        Schema::create('essay_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('answer_id')->constrained('candidate_answers')->cascadeOnDelete();
            $table->foreignId('reviewer_id')->constrained('users')->restrictOnDelete();
            $table->decimal('score', 8, 2)->nullable();
            $table->text('notes')->nullable();
            $table->text('internal_notes')->nullable();
            $table->enum('status', ['draft', 'final'])->default('draft');
            $table->timestamp('finalized_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'reviewer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('essay_reviews');
    }
};

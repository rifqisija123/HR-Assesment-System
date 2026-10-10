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
        Schema::create('test_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_candidate_id')->constrained('session_candidates')->cascadeOnDelete();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('submitted_at')->nullable();
            $table->integer('time_remaining_seconds')->nullable();
            $table->decimal('objective_score', 10, 2)->nullable();
            $table->decimal('essay_score', 10, 2)->nullable();
            $table->decimal('total_score', 10, 2)->nullable();
            $table->boolean('is_passed')->nullable();
            $table->enum('status', [
                'in_progress',
                'submitted',
                'auto_submitted',
                'awaiting_review',
                'reviewed',
                'final',
            ])->default('in_progress');
            $table->enum('submitted_by', ['candidate', 'system', 'admin'])->nullable();
            $table->timestamps();

            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_attempts');
    }
};

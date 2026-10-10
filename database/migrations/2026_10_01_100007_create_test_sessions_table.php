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
        Schema::create('test_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained('test_packages')->restrictOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('instructions')->nullable();
            $table->dateTime('scheduled_start');
            $table->dateTime('scheduled_end');
            $table->unsignedInteger('duration_minutes');
            $table->decimal('passing_grade', 5, 2)->nullable();
            $table->boolean('is_passing_grade_enabled')->default(false);
            $table->boolean('shuffle_questions')->default(false);
            $table->decimal('total_max_score', 10, 2)->default(0);
            $table->boolean('allow_candidate_view_result')->default(false);
            $table->enum('status', [
                'draft',
                'scheduled',
                'active',
                'completed',
                'in_review',
                'final',
                'cancelled',
                'archived',
            ])->default('draft');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['status', 'scheduled_start', 'scheduled_end']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_sessions');
    }
};

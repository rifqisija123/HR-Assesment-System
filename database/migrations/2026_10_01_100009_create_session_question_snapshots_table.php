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
        Schema::create('session_question_snapshots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('test_sessions')->cascadeOnDelete();
            $table->foreignId('question_id')->nullable()->constrained('questions')->nullOnDelete();
            $table->unsignedInteger('order')->default(0);
            $table->enum('type', ['multiple_choice', 'essay']);
            $table->text('question_text');
            $table->string('question_image')->nullable();
            $table->decimal('max_score', 8, 2);
            $table->text('essay_rubric')->nullable();
            $table->text('essay_instruction')->nullable();
            $table->json('options_snapshot')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_question_snapshots');
    }
};

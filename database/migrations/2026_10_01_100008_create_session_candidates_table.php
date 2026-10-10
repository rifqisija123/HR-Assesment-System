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
        Schema::create('session_candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('test_sessions')->cascadeOnDelete();
            $table->foreignId('candidate_id')->constrained('candidates')->restrictOnDelete();
            $table->string('token')->unique();
            $table->string('token_plain')->nullable();
            $table->dateTime('token_expires_at')->nullable();
            $table->enum('invitation_status', [
                'not_sent',
                'sent',
                'opened',
                'started',
                'submitted',
                'expired',
                'cancelled',
            ])->default('not_sent');
            $table->timestamp('invitation_sent_at')->nullable();
            $table->timestamp('invitation_opened_at')->nullable();
            $table->timestamps();

            $table->unique(['session_id', 'candidate_id']);
            $table->index('invitation_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_candidates');
    }
};

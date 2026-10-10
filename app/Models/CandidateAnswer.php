<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CandidateAnswer extends Model
{
    protected $fillable = [
        'attempt_id',
        'snapshot_id',
        'answer_text',
        'selected_option_id',
        'is_correct',
        'score',
        'is_answered',
        'answered_at',
    ];

    protected function casts(): array
    {
        return [
            'is_correct' => 'boolean',
            'is_answered' => 'boolean',
            'score' => 'decimal:2',
            'answered_at' => 'datetime',
        ];
    }

    // ── Relationships ─────────────────────────────────────

    public function attempt(): BelongsTo
    {
        return $this->belongsTo(TestAttempt::class, 'attempt_id');
    }

    public function questionSnapshot(): BelongsTo
    {
        return $this->belongsTo(SessionQuestionSnapshot::class, 'snapshot_id');
    }

    public function essayReview(): HasOne
    {
        return $this->hasOne(EssayReview::class, 'answer_id');
    }
}

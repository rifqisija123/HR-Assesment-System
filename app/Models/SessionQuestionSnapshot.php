<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SessionQuestionSnapshot extends Model
{
    protected $fillable = [
        'session_id',
        'question_id',
        'order',
        'type',
        'question_text',
        'question_image',
        'max_score',
        'essay_rubric',
        'essay_instruction',
        'options_snapshot',
    ];

    protected function casts(): array
    {
        return [
            'max_score' => 'decimal:2',
            'options_snapshot' => 'array',
        ];
    }

    // ── Relationships ─────────────────────────────────────

    public function session(): BelongsTo
    {
        return $this->belongsTo(TestSession::class, 'session_id');
    }

    public function originalQuestion(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(CandidateAnswer::class, 'snapshot_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestAttempt extends Model
{
    protected $fillable = [
        'session_candidate_id',
        'started_at',
        'submitted_at',
        'time_remaining_seconds',
        'objective_score',
        'essay_score',
        'total_score',
        'is_passed',
        'status',
        'submitted_by',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'submitted_at' => 'datetime',
            'objective_score' => 'decimal:2',
            'essay_score' => 'decimal:2',
            'total_score' => 'decimal:2',
            'is_passed' => 'boolean',
        ];
    }

    // ── Relationships ─────────────────────────────────────

    public function sessionCandidate(): BelongsTo
    {
        return $this->belongsTo(SessionCandidate::class, 'session_candidate_id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(CandidateAnswer::class, 'attempt_id');
    }
}

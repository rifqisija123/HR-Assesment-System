<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EssayReview extends Model
{
    protected $fillable = [
        'answer_id',
        'reviewer_id',
        'score',
        'notes',
        'internal_notes',
        'status',
        'finalized_at',
    ];

    protected function casts(): array
    {
        return [
            'score' => 'decimal:2',
            'finalized_at' => 'datetime',
        ];
    }

    // ── Relationships ─────────────────────────────────────

    public function answer(): BelongsTo
    {
        return $this->belongsTo(CandidateAnswer::class, 'answer_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}

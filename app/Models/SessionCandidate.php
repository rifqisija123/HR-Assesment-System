<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SessionCandidate extends Model
{
    protected $fillable = [
        'session_id',
        'candidate_id',
        'token',
        'token_plain',
        'token_expires_at',
        'invitation_status',
        'invitation_sent_at',
        'invitation_opened_at',
    ];

    protected function casts(): array
    {
        return [
            'token_expires_at' => 'datetime',
            'invitation_sent_at' => 'datetime',
            'invitation_opened_at' => 'datetime',
        ];
    }

    // ── Relationships ─────────────────────────────────────

    public function session(): BelongsTo
    {
        return $this->belongsTo(TestSession::class, 'session_id');
    }

    public function candidate(): BelongsTo
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    public function attempt(): HasOne
    {
        return $this->hasOne(TestAttempt::class, 'session_candidate_id');
    }
}

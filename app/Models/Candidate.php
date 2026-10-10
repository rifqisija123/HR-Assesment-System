<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Candidate extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'identity_number',
        'metadata',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'metadata' => 'array',
        ];
    }

    // ── Relationships ─────────────────────────────────────

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function sessionCandidates(): HasMany
    {
        return $this->hasMany(SessionCandidate::class, 'candidate_id');
    }

    public function sessions(): BelongsToMany
    {
        return $this->belongsToMany(TestSession::class, 'session_candidates', 'candidate_id', 'session_id')
                    ->withPivot(['token', 'invitation_status', 'invitation_sent_at'])
                    ->withTimestamps();
    }
}

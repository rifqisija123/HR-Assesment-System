<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestSession extends Model
{
    protected $fillable = [
        'package_id',
        'name',
        'description',
        'instructions',
        'scheduled_start',
        'scheduled_end',
        'duration_minutes',
        'passing_grade',
        'is_passing_grade_enabled',
        'shuffle_questions',
        'total_max_score',
        'allow_candidate_view_result',
        'status',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_start' => 'datetime',
            'scheduled_end' => 'datetime',
            'duration_minutes' => 'integer',
            'passing_grade' => 'decimal:2',
            'is_passing_grade_enabled' => 'boolean',
            'shuffle_questions' => 'boolean',
            'total_max_score' => 'decimal:2',
            'allow_candidate_view_result' => 'boolean',
        ];
    }

    // ── Relationships ─────────────────────────────────────

    public function package(): BelongsTo
    {
        return $this->belongsTo(TestPackage::class, 'package_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function sessionCandidates(): HasMany
    {
        return $this->hasMany(SessionCandidate::class, 'session_id');
    }

    public function candidates(): BelongsToMany
    {
        return $this->belongsToMany(Candidate::class, 'session_candidates', 'session_id', 'candidate_id')
                    ->withPivot(['token', 'invitation_status', 'invitation_sent_at'])
                    ->withTimestamps();
    }

    public function questionSnapshots(): HasMany
    {
        return $this->hasMany(SessionQuestionSnapshot::class, 'session_id')->orderBy('order');
    }
}

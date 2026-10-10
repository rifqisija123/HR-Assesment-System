<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestPackage extends Model
{
    protected $fillable = [
        'name',
        'description',
        'duration_minutes',
        'passing_grade',
        'is_passing_grade_enabled',
        'shuffle_questions',
        'total_max_score',
        'status',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'duration_minutes' => 'integer',
            'passing_grade' => 'decimal:2',
            'is_passing_grade_enabled' => 'boolean',
            'shuffle_questions' => 'boolean',
            'total_max_score' => 'decimal:2',
        ];
    }

    // ── Relationships ─────────────────────────────────────

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'package_questions', 'package_id', 'question_id')
                    ->withPivot('order')
                    ->withTimestamps()
                    ->orderByPivot('order');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(TestSession::class, 'package_id');
    }
}

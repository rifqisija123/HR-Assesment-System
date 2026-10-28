<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuestionCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'total_questions',
        'is_active',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'is_active'       => 'boolean',
            'total_questions' => 'integer',
        ];
    }

    // ── Helpers ───────────────────────────────────────────

    public function isMultipleChoice(): bool
    {
        return $this->type === 'multiple_choice';
    }

    public function isEssay(): bool
    {
        return $this->type === 'essay';
    }

    protected $appends = [
        'type_label',
        'status_label',
    ];

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'essay' => 'Essay',
            default => 'Pilihan ganda',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return $this->is_active ? 'Aktif' : 'Nonaktif';
    }

    // ── Relationships ─────────────────────────────────────

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'category_id');
    }
}

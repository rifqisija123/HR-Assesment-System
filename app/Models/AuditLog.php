<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AuditLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'action',
        'auditable_type',
        'auditable_id',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'old_values' => 'array',
            'new_values' => 'array',
            'created_at' => 'datetime',
        ];
    }

    // ── Relationships ─────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function auditable(): MorphTo
    {
        return $this->morphTo();
    }

    // ── Accessors & Helpers ───────────────────────────────

    /**
     * Deskripsi aktivitas yang mudah dibaca.
     */
    public function getDescriptionAttribute(): string
    {
        if (
            class_basename($this->auditable_type ?? '') === 'QuestionCategory'
            && !empty($this->new_values['name'])
            && in_array(strtolower($this->action), ['create', 'update'], true)
        ) {
            $desc = (string) ($this->new_values['description'] ?? '');
            if (
                !str_starts_with($desc, 'Menambahkan kategori soal:')
                && !str_starts_with($desc, 'Memperbarui kategori soal:')
            ) {
                return strtolower($this->action) === 'create'
                    ? 'Menambahkan kategori soal: ' . $this->new_values['name']
                    : 'Memperbarui kategori soal: ' . $this->new_values['name'];
            }
        }

        if (!empty($this->new_values['description'])) {
            return $this->new_values['description'];
        }

        $entity = $this->entity_type_label;
        $idPart = $this->auditable_id ? " #{$this->auditable_id}" : '';

        return match (strtolower($this->action)) {
            'login'          => 'Berhasil masuk ke sistem',
            'logout'         => 'Keluar dari sistem',
            'create'         => "Membuat data {$entity}{$idPart}",
            'update'         => "Mengubah data {$entity}{$idPart}",
            'delete'         => "Menghapus data {$entity}{$idPart}",
            'get'            => "Mengakses halaman {$entity}",
            'reset_password' => "Mengirim reset password untuk {$entity}",
            default          => ucfirst($this->action) . " {$entity}",
        };
    }

    /**
     * Label jenis entitas.
     */
    public function getEntityTypeLabelAttribute(): string
    {
        if (!$this->auditable_type) {
            if (in_array(strtolower($this->action), ['login', 'logout'])) {
                return 'User Session';
            }
            if (strtolower($this->action) === 'get') {
                return 'Halaman Web';
            }
            return 'System';
        }

        $base = class_basename($this->auditable_type);
        return match ($base) {
            'User'                   => 'User',
            'TestSession'            => 'Test Session',
            'TestPackage'            => 'Test Package',
            'QuestionCategory'       => 'Question Category',
            'Question'               => 'Question Bank',
            'Candidate'              => 'Candidate',
            'CompanySetting'         => 'Company Setting',
            'SystemSetting'          => 'System Setting',
            'EssayReview'            => 'Essay Review',
            'SessionCandidate'       => 'Session Candidate',
            'Invitation'             => 'Invitation',
            default                  => preg_replace('/(?<!\ )[A-Z]/', ' $0', $base),
        };
    }

    /**
     * Identifier entitas (ID atau nomor).
     */
    public function getEntityIdentifierAttribute(): string
    {
        if (!empty($this->new_values['entity_code'])) {
            return $this->new_values['entity_code'];
        }

        if ($this->auditable_id) {
            $base = class_basename($this->auditable_type ?? '');
            $prefix = match ($base) {
                'TestSession' => 'TS-',
                'User'        => 'USR-',
                'Question'    => 'Q-',
                default       => '#',
            };
            return $prefix === '#' ? "#{$this->auditable_id}" : "ID: #{$prefix}{$this->auditable_id}";
        }

        return '-';
    }

    /**
     * Label peran pengguna.
     */
    public function getUserRoleLabelAttribute(): string
    {
        if (!$this->user) {
            return 'System';
        }

        return match ($this->user->role) {
            'super_admin' => 'Super Admin',
            'hr_admin'    => 'HR Admin',
            'reviewer'    => 'Reviewer',
            default       => ucfirst(str_replace('_', ' ', $this->user->role)),
        };
    }

    /**
     * Inisial avatar pengguna.
     */
    public function getUserInitialsAttribute(): string
    {
        if (!$this->user) {
            return 'SYS';
        }

        $parts = preg_split('/\s+/', trim($this->user->name));
        if (count($parts) >= 2) {
            return strtoupper(mb_substr($parts[0], 0, 1) . mb_substr($parts[1], 0, 1));
        }

        return strtoupper(mb_substr($this->user->name, 0, 2));
    }

    /**
     * Style CSS avatar pengguna berdasarkan peran.
     */
    public function getUserAvatarStyleAttribute(): array
    {
        if (!$this->user) {
            return ['bg' => 'bg-[#E2F4F3]', 'text' => 'text-[#147D92]'];
        }

        return match ($this->user->role) {
            'super_admin' => ['bg' => 'bg-[#D1F0ED]', 'text' => 'text-[#125A6B]'],
            'hr_admin'    => ['bg' => 'bg-[#EFE9FB]', 'text' => 'text-[#7257B7]'],
            'reviewer'    => ['bg' => 'bg-[#FFE4E6]', 'text' => 'text-[#E11D48]'],
            default       => ['bg' => 'bg-[#E2E8F0]', 'text' => 'text-[#475569]'],
        };
    }

    /**
     * Style CSS badge aktivitas.
     */
    public function getActionStyleAttribute(): array
    {
        return match (strtolower($this->action)) {
            'create' => [
                'label' => 'Create',
                'bg'    => 'bg-[#E7F6EE]',
                'text'  => 'text-[#19734A]',
                'border'=> 'border-[#198754]/20',
            ],
            'update' => [
                'label' => 'Update',
                'bg'    => 'bg-[#FFF3DF]',
                'text'  => 'text-[#B45309]',
                'border'=> 'border-[#D97706]/20',
            ],
            'delete' => [
                'label' => 'Delete',
                'bg'    => 'bg-[#FEE2E2]',
                'text'  => 'text-[#B91C1C]',
                'border'=> 'border-[#EF4444]/20',
            ],
            'login' => [
                'label' => 'Login',
                'bg'    => 'bg-[#F1F5F9]',
                'text'  => 'text-[#475569]',
                'border'=> 'border-[#94A3B8]/20',
            ],
            'logout' => [
                'label' => 'Logout',
                'bg'    => 'bg-[#F3E8FF]',
                'text'  => 'text-[#7E22CE]',
                'border'=> 'border-[#A855F7]/20',
            ],
            'get' => [
                'label' => 'GET',
                'bg'    => 'bg-[#E0F2FE]',
                'text'  => 'text-[#0284C7]',
                'border'=> 'border-[#0284C7]/20',
            ],
            'reset_password' => [
                'label' => 'Reset Pwd',
                'bg'    => 'bg-[#FEF3C7]',
                'text'  => 'text-[#B45309]',
                'border'=> 'border-[#F59E0B]/20',
            ],
            default => [
                'label' => ucfirst($this->action),
                'bg'    => 'bg-[#F1F5F9]',
                'text'  => 'text-[#475569]',
                'border'=> 'border-[#94A3B8]/20',
            ],
        };
    }

    /**
     * Parse informasi browser dan sistem operasi dari User Agent.
     */
    public function getBrowserInfoAttribute(): array
    {
        $ua = $this->user_agent ?? '';

        // Deteksi OS
        $os = 'Unknown OS';
        if (stripos($ua, 'Windows NT 10.0') !== false) {
            $os = 'Windows 10/11';
        } elseif (stripos($ua, 'Windows NT 6.3') !== false) {
            $os = 'Windows 8.1';
        } elseif (stripos($ua, 'Windows') !== false) {
            $os = 'Windows';
        } elseif (stripos($ua, 'Macintosh') !== false || stripos($ua, 'Mac OS X') !== false) {
            $os = 'macOS';
        } elseif (stripos($ua, 'Android') !== false) {
            $os = 'Android';
        } elseif (stripos($ua, 'iPhone') !== false || stripos($ua, 'iPad') !== false) {
            $os = 'iOS';
        } elseif (stripos($ua, 'Linux') !== false) {
            $os = 'Linux';
        } elseif (stripos($ua, 'Server Cron') !== false) {
            $os = 'Linux';
        }

        // Deteksi Browser
        $browser = 'Unknown Browser';
        if (stripos($ua, 'Server Cron') !== false) {
            $browser = 'Server Cron';
        } elseif (preg_match('/Edg\/([0-9\.]+)/i', $ua, $matches)) {
            $browser = 'Edge ' . explode('.', $matches[1])[0] . '.' . (explode('.', $matches[1])[1] ?? '0');
        } elseif (preg_match('/Chrome\/([0-9\.]+)/i', $ua, $matches)) {
            $browser = 'Chrome ' . explode('.', $matches[1])[0] . '.' . (explode('.', $matches[1])[1] ?? '0');
        } elseif (preg_match('/Firefox\/([0-9\.]+)/i', $ua, $matches)) {
            $browser = 'Firefox ' . explode('.', $matches[1])[0] . '.' . (explode('.', $matches[1])[1] ?? '0');
        } elseif (preg_match('/Version\/([0-9\.]+).*Safari/i', $ua, $matches)) {
            $browser = 'Safari ' . explode('.', $matches[1])[0] . '.' . (explode('.', $matches[1])[1] ?? '0');
        } elseif (stripos($ua, 'Safari') !== false) {
            $browser = 'Safari';
        } elseif (stripos($ua, 'Postman') !== false) {
            $browser = 'Postman API';
        } elseif (stripos($ua, 'curl') !== false) {
            $browser = 'cURL CLI';
        }

        return [
            'browser' => $browser,
            'os'      => $os,
            'full'    => $ua,
        ];
    }

    /**
     * Format tanggal dalam bahasa Indonesia.
     */
    public function getFormattedDateAttribute(): string
    {
        $tz = config('app.timezone', 'Asia/Jakarta');
        $dt = $this->created_at ? Carbon::parse($this->created_at)->setTimezone($tz) : now($tz);
        $months = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
            7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des',
        ];
        return $dt->format('d') . ' ' . ($months[(int) $dt->format('n')] ?? $dt->format('M')) . ' ' . $dt->format('Y');
    }

    /**
     * Format waktu dalam WIB.
     */
    public function getFormattedTimeAttribute(): string
    {
        $tz = config('app.timezone', 'Asia/Jakarta');
        $dt = $this->created_at ? Carbon::parse($this->created_at)->setTimezone($tz) : now($tz);
        return $dt->format('H:i:s') . ' WIB';
    }
}

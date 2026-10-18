<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditLogger
{
    /**
     * Catat aktivitas pengguna ke dalam tabel audit_logs.
     */
    public static function log(
        string $action,
        string $description,
        Model|Authenticatable|null $auditable = null,
        ?array $oldValues = null,
        ?array $newValues = null,
        User|Authenticatable|null $user = null,
        ?Request $request = null,
        ?\DateTimeInterface $timestamp = null,
    ): AuditLog {
        $request = $request ?? request();
        $user = $user ?? Auth::user();

        $payload = $newValues ?? [];
        if (!isset($payload['description'])) {
            $payload['description'] = $description;
        }

        $userId = null;
        if ($user instanceof Authenticatable) {
            $userId = $user->getAuthIdentifier();
        } elseif ($user instanceof Model) {
            $userId = $user->getKey();
        }

        $auditableId = null;
        if ($auditable instanceof Model) {
            $auditableId = $auditable->getKey();
        } elseif ($auditable instanceof Authenticatable) {
            $auditableId = $auditable->getAuthIdentifier();
        }

        return AuditLog::create([
            'user_id'        => $userId,
            'action'         => strtolower($action),
            'auditable_type' => $auditable ? get_class($auditable) : null,
            'auditable_id'   => $auditableId,
            'old_values'     => $oldValues,
            'new_values'     => $payload,
            'ip_address'     => $request?->ip() ?? '127.0.0.1',
            'user_agent'     => $request?->userAgent() ?? 'System',
            'created_at'     => $timestamp ?? now(config('app.timezone', 'Asia/Jakarta')),
        ]);
    }
}

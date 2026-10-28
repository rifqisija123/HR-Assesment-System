<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Riwayat Aktivitas</title>
    <style>
        @page {
            margin: 12mm 10mm 14mm 10mm;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #102A43;
            font-size: 8.5pt;
            line-height: 1.35;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        /* ── Header Dokumen ────────────────────────── */
        .header-table {
            width: 100%;
            border-bottom: 2px solid #147D92;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }

        .header-title-main {
            font-size: 15pt;
            font-weight: bold;
            color: #147D92;
            letter-spacing: -0.02em;
            text-transform: uppercase;
            margin: 0;
        }

        .header-subtitle {
            font-size: 9pt;
            color: #62798A;
            margin-top: 2px;
        }

        .system-badge {
            background-color: #E2F4F3;
            color: #147D92;
            font-size: 7.5pt;
            font-weight: bold;
            padding: 3px 8px;
            border-radius: 4px;
            display: inline-block;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        /* ── Metadata Box ──────────────────────────── */
        .meta-box {
            width: 100%;
            background-color: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 6px;
            padding: 8px 10px;
            margin-bottom: 14px;
        }

        .meta-table {
            width: 100%;
            border-collapse: collapse;
        }

        .meta-table td {
            font-size: 8pt;
            vertical-align: top;
            padding: 2px 4px;
        }

        .meta-label {
            color: #62798A;
            width: 15%;
            font-weight: 500;
        }

        .meta-value {
            color: #102A43;
            font-weight: bold;
            width: 35%;
        }

        /* ── Tabel Data Log ────────────────────────── */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .data-table th {
            background-color: #147D92;
            color: #FFFFFF;
            font-size: 7.5pt;
            font-weight: bold;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            padding: 7px 6px;
            text-align: left;
            border: 1px solid #147D92;
        }

        .data-table td {
            padding: 6px 6px;
            border-bottom: 1px solid #EDF2F5;
            border-left: 1px solid #EDF2F5;
            border-right: 1px solid #EDF2F5;
            font-size: 8pt;
            vertical-align: top;
            word-wrap: break-word;
        }

        .data-table tr.even {
            background-color: #FAFCFD;
        }

        .data-table tr {
            page-break-inside: avoid;
        }

        /* ── Badge Styling ─────────────────────────── */
        .badge {
            display: inline-block;
            padding: 2px 5px;
            border-radius: 3px;
            font-size: 7pt;
            font-weight: bold;
            letter-spacing: 0.02em;
            text-transform: uppercase;
        }

        .badge-login { background-color: #DBEAFE; color: #1E40AF; }
        .badge-logout { background-color: #F1F5F9; color: #475569; }
        .badge-create { background-color: #DCFCE7; color: #166534; }
        .badge-update { background-color: #FEF3C7; color: #92400E; }
        .badge-delete { background-color: #FFE4E6; color: #9F1239; }
        .badge-get { background-color: #E0F2FE; color: #0369A1; }
        .badge-default { background-color: #F1F5F9; color: #334155; }

        .role-badge {
            display: inline-block;
            font-size: 6.8pt;
            font-weight: 600;
            padding: 1.5px 5px;
            border-radius: 3px;
            margin-top: 2px;
        }

        .role-super_admin { background-color: #F3E8FF; color: #6B21A8; }
        .role-hr_admin { background-color: #E2F4F3; color: #0F677A; }
        .role-candidate { background-color: #FEF3C7; color: #92400E; }
        .role-system { background-color: #F1F5F9; color: #475569; }

        .text-muted {
            color: #62798A;
            font-size: 7.2pt;
        }

        .text-bold {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .code-box {
            font-family: 'Courier New', Courier, monospace;
            font-size: 7.2pt;
            background-color: #F1F5F9;
            color: #0F172A;
            padding: 1px 3px;
            border-radius: 2px;
            display: inline-block;
        }

        /* ── Footer Dokumen ────────────────────────── */
        .footer {
            position: fixed;
            bottom: -10mm;
            left: 0;
            right: 0;
            height: 7mm;
            font-size: 7.2pt;
            color: #62798A;
            border-top: 1px solid #DDE6ED;
            padding-top: 3px;
        }

        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .footer-table td {
            padding: 0;
            vertical-align: middle;
        }

        .page-number:before {
            content: "Halaman " counter(page);
        }

        .empty-row {
            text-align: center;
            padding: 24px !important;
            color: #62798A;
            font-style: italic;
        }
    </style>
</head>
<body>

    <!-- Footer halaman tercetak otomatis -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="text-align: left;">
                    <strong>HR Assessment System</strong> &bull; Laporan Audit Riwayat Aktivitas &bull; <em>Dokumen Rahasia Internal</em>
                </td>
                <td style="text-align: right;" class="page-number"></td>
            </tr>
        </table>
    </div>

    <!-- Header Dokumen -->
    <table class="header-table">
        <tr>
            <td style="vertical-align: middle;">
                <div class="system-badge">Audit Logs Report</div>
                <h1 class="header-title-main">Riwayat Aktivitas Pengguna & Sistem</h1>
                <div class="header-subtitle">
                    Laporan audit trail mencakup tindakan pengguna, waktu, alamat IP, dan perangkat peramban.
                </div>
            </td>
            <td style="text-align: right; vertical-align: middle; width: 220px;">
                <div style="font-size: 13pt; font-weight: bold; color: #147D92; letter-spacing: 0.05em;">HR ASSESSMENT</div>
                <div style="font-size: 7.5pt; color: #62798A; letter-spacing: 0.03em;">ENTERPRISE AUDIT TRAIL</div>
            </td>
        </tr>
    </table>

    <!-- Info Metadata Box -->
    <div class="meta-box">
        <table class="meta-table">
            <tr>
                <td class="meta-label">Tanggal Cetak:</td>
                <td class="meta-value">{{ $generatedAt->translatedFormat('l, d F Y - H:i:s') }} WIB</td>
                <td class="meta-label">Total Data:</td>
                <td class="meta-value">{{ number_format($logs->count(), 0, ',', '.') }} Rekaman Aktivitas</td>
            </tr>
            <tr>
                <td class="meta-label">Dicetak Oleh:</td>
                <td class="meta-value">
                    {{ $generatedBy?->name ?? 'Administrator' }} 
                    <span class="text-muted">({{ $generatedBy?->email ?? '-' }})</span>
                </td>
                <td class="meta-label">Filter Diterapkan:</td>
                <td class="meta-value" style="font-weight: normal; color: #334155;">
                    @php
                        $filterItems = [];
                        if (!empty($filters['search'])) $filterItems[] = 'Cari: "' . $filters['search'] . '"';
                        if (!empty($filters['user_id'])) $filterItems[] = 'Pengguna: ' . ($filteredUser ?? $filters['user_id']);
                        if (!empty($filters['role'])) $filterItems[] = 'Peran: ' . ucfirst(str_replace('_', ' ', $filters['role']));
                        if (!empty($filters['action'])) $filterItems[] = 'Aksi: ' . strtoupper($filters['action']);
                        if (!empty($filters['date_from']) && !empty($filters['date_to'])) {
                            $filterItems[] = 'Periode: ' . $filters['date_from'] . ' s/d ' . $filters['date_to'];
                        } elseif (!empty($filters['date_from'])) {
                            $filterItems[] = 'Mulai: ' . $filters['date_from'];
                        } elseif (!empty($filters['date_to'])) {
                            $filterItems[] = 'Sampai: ' . $filters['date_to'];
                        }
                    @endphp

                    @if(count($filterItems) > 0)
                        {{ implode(' | ', $filterItems) }}
                    @else
                        <em>Semua Data (Tanpa Filter)</em>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <!-- Tabel Data Log -->
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 3%; text-align: center;">No</th>
                <th style="width: 13%;">Waktu & Tanggal</th>
                <th style="width: 20%;">Pengguna</th>
                <th style="width: 25%;">Aktivitas & Deskripsi</th>
                <th style="width: 17%;">Entitas Terkait</th>
                <th style="width: 22%;">IP & Perangkat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $index => $log)
                @php
                    $action = strtolower($log->action ?? '');
                    $badgeClass = match($action) {
                        'login' => 'badge-login',
                        'logout' => 'badge-logout',
                        'create' => 'badge-create',
                        'update' => 'badge-update',
                        'delete' => 'badge-delete',
                        'get' => 'badge-get',
                        default => 'badge-default',
                    };
                    $userRole = $log->user?->role ?? 'system';
                    $roleClass = match($userRole) {
                        'super_admin' => 'role-super_admin',
                        'hr_admin' => 'role-hr_admin',
                        'candidate' => 'role-candidate',
                        default => 'role-system',
                    };
                    $browser = $log->browser_info;
                @endphp
                <tr class="{{ $index % 2 === 1 ? 'even' : '' }}">
                    <td class="text-center text-muted" style="font-size: 7.5pt;">{{ $index + 1 }}</td>
                    <td>
                        <div class="text-bold">{{ $log->formatted_date }}</div>
                        <div class="text-muted">{{ $log->formatted_time }} WIB</div>
                    </td>
                    <td>
                        <div class="text-bold">{{ $log->user?->name ?? 'System Auto' }}</div>
                        <div class="text-muted">{{ $log->user?->email ?? 'system@internal' }}</div>
                        <span class="role-badge {{ $roleClass }}">{{ $log->user_role_label }}</span>
                    </td>
                    <td>
                        <div>
                            <span class="badge {{ $badgeClass }}">{{ strtoupper($log->action) }}</span>
                        </div>
                        <div style="margin-top: 3px; line-height: 1.3;">
                            {{ $log->description }}
                        </div>
                    </td>
                    <td>
                        <div class="text-bold">{{ $log->entity_type_label }}</div>
                        <div class="text-muted" style="margin-top: 1px;">
                            ID: <span class="code-box">{{ $log->entity_identifier }}</span>
                        </div>
                    </td>
                    <td>
                        <div>
                            IP: <span class="code-box">{{ $log->ip_address ?? '127.0.0.1' }}</span>
                        </div>
                        <div class="text-muted" style="margin-top: 2px;">
                            {{ $browser['browser'] ?? '-' }} &bull; {{ $browser['os'] ?? '-' }}
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty-row">
                        Tidak ada riwayat aktivitas yang ditemukan untuk kriteria filter ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>

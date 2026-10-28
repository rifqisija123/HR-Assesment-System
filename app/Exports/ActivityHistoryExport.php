<?php

namespace App\Exports;

use App\Models\AuditLog;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Export;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ActivityHistoryExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithTitle, Export
{
    protected array $filters;
    protected int $rowNumber = 0;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * Mengambil seluruh data riwayat aktivitas (dengan opsi filter jika ada).
     */
    public function collection(): Collection
    {
        $query = AuditLog::with('user');

        // Filter: Pencarian teks
        if (!empty($this->filters['search'])) {
            $search = trim($this->filters['search']);
            $query->where(function ($q) use ($search) {
                $term = "%{$search}%";
                $q->where('action', 'like', $term)
                  ->orWhere('ip_address', 'like', $term)
                  ->orWhere('user_agent', 'like', $term)
                  ->orWhere('new_values->description', 'like', $term)
                  ->orWhere('new_values->entity_code', 'like', $term)
                  ->orWhereHas('user', function ($uq) use ($term) {
                      $uq->where('name', 'like', $term)
                         ->orWhere('email', 'like', $term);
                  });

                if (stripos('System', $search) !== false || stripos('Auto', $search) !== false) {
                    $q->orWhereNull('user_id');
                }
            });
        }

        // Filter: Pengguna tertentu
        if (!empty($this->filters['user_id'])) {
            if ($this->filters['user_id'] === 'system') {
                $query->whereNull('user_id');
            } else {
                $query->where('user_id', $this->filters['user_id']);
            }
        }

        // Filter: Role pengguna
        if (!empty($this->filters['role'])) {
            if ($this->filters['role'] === 'system') {
                $query->whereNull('user_id');
            } else {
                $query->whereHas('user', function ($uq) {
                    $uq->where('role', $this->filters['role']);
                });
            }
        }

        // Filter: Jenis aktivitas (action)
        if (!empty($this->filters['action'])) {
            $query->where('action', strtolower($this->filters['action']));
        }

        // Filter: Rentang Tanggal Mulai
        if (!empty($this->filters['date_from'])) {
            $query->whereDate('created_at', '>=', $this->filters['date_from']);
        }

        // Filter: Rentang Tanggal Selesai
        if (!empty($this->filters['date_to'])) {
            $query->whereDate('created_at', '<=', $this->filters['date_to']);
        }

        return $query->latest('created_at')->latest('id')->get();
    }

    /**
     * Mapping data kolom untuk setiap baris data di file Excel.
     */
    public function map(mixed $log): array
    {
        /** @var AuditLog $log */
        $this->rowNumber++;

        $browserInfo = $log->browser_info;

        return [
            $this->rowNumber,
            '#LOG-' . $log->id,
            $log->formatted_date,
            $log->formatted_time,
            $log->user?->name ?? 'System Auto',
            $log->user?->email ?? '-',
            $log->user_role_label,
            strtoupper($log->action),
            $log->description,
            $log->entity_type_label,
            $log->entity_identifier,
            $log->ip_address ?? '127.0.0.1',
            $browserInfo['browser'] ?? '-',
            $browserInfo['os'] ?? '-',
            $log->user_agent ?? '-',
        ];
    }

    /**
     * Header kolom spreadsheet.
     */
    public function headings(): array
    {
        return [
            'NO',
            'ID LOG',
            'TANGGAL',
            'WAKTU',
            'NAMA PENGGUNA',
            'EMAIL',
            'PERAN (ROLE)',
            'TIPE AKTIVITAS',
            'DESKRIPSI AKTIVITAS',
            'TIPE ENTITAS',
            'ID / KODE ENTITAS',
            'IP ADDRESS',
            'BROWSER',
            'SISTEM OPERASI',
            'USER AGENT LENGKAP',
        ];
    }

    /**
     * Nama sheet dalam file Excel.
     */
    public function title(): string
    {
        return 'Riwayat Aktivitas';
    }

    /**
     * Styling spreadsheet.
     */
    public function styles(Worksheet $sheet): ?array
    {
        // Styling Header (Baris 1)
        $sheet->getStyle('A1:O1')->getFont()->setBold(true)->setSize(11)->getColor()->setARGB('FFFFFFFF');
        $sheet->getStyle('A1:O1')->getFill()->setFillType(Fill::FILL_SOLID)
              ->getStartColor()->setARGB('FF147D92'); // Signature Teal #147D92
        $sheet->getStyle('A1:O1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getRowDimension(1)->setRowHeight(28);

        // Freeze pane baris pertama (header tetap terlihat saat di-scroll)
        $sheet->freezePane('A2');

        // Center alignment untuk kolom-kolom tertentu
        $sheet->getStyle('A')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('C')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('G')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('H')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('L')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $highestRow = $sheet->getHighestRow();
        if ($highestRow >= 2) {
            // Border tipis rapi untuk seluruh tabel
            $sheet->getStyle("A1:O{$highestRow}")->getBorders()->getAllBorders()->setBorderStyle(
                Border::BORDER_THIN
            )->getColor()->setARGB('FFDDE6ED');

            // Alignment vertikal tengah untuk semua baris data
            $sheet->getStyle("A2:O{$highestRow}")->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

            // Set tinggi baris data yang nyaman
            for ($row = 2; $row <= $highestRow; $row++) {
                $sheet->getRowDimension($row)->setRowHeight(22);
            }
        }

        return [];
    }
}

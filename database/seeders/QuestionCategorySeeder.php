<?php

namespace Database\Seeders;

use App\Models\QuestionCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class QuestionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hrAdmin = User::where('role', 'hr_admin')->first() ?? User::first();
        $adminId = $hrAdmin?->id;

        $categories = [
            [
                'name'            => 'Logika & Penalaran',
                'description'     => 'Mengukur kemampuan berpikir logis, analitis, dan penyelesaian masalah dasar.',
                'type'            => 'multiple_choice',
                'total_questions' => 14,
                'is_active'       => true,
                'created_by'      => $adminId,
            ],
            [
                'name'            => 'Kompetensi Bidang',
                'description'     => 'Evaluasi keahlian teknis, pemahaman domain pekerjaan, dan studi kasus profesional.',
                'type'            => 'essay',
                'total_questions' => 20,
                'is_active'       => true,
                'created_by'      => $adminId,
            ],
            [
                'name'            => 'Kepemimpinan & Manajerial',
                'description'     => 'Penilaian potensi kepemimpinan, pengambilan keputusan, dan manajemen tim.',
                'type'            => 'multiple_choice',
                'total_questions' => 12,
                'is_active'       => true,
                'created_by'      => $adminId,
            ],
            [
                'name'            => 'Kemampuan Bahasa & Komunikasi',
                'description'     => 'Ujian komprehensif tata bahasa, pemahaman bacaan, dan komunikasi tertulis.',
                'type'            => 'essay',
                'total_questions' => 8,
                'is_active'       => false,
                'created_by'      => $adminId,
            ],
        ];

        foreach ($categories as $cat) {
            QuestionCategory::updateOrCreate(
                ['name' => $cat['name']],
                $cat
            );
        }
    }
}

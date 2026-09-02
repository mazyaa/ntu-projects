<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            ['name' => 'K3 Pesawat Angkat & Angkut', 'slug' => 'k3-pesawat-angkat-angkut'],
            ['name' => 'Inspection', 'slug' => 'inspection'],
            ['name' => 'Engineering', 'slug' => 'engineering'],
            ['name' => 'Boiler', 'slug' => 'boiler'],
            ['name' => 'Pressure Vessel', 'slug' => 'pressure-vessel'],
            ['name' => 'K3 Training', 'slug' => 'k3-training'],
            ['name' => 'Riset Terapan', 'slug' => 'riset-terapan'],
            ['name' => 'Pengembangan Teknologi', 'slug' => 'pengembangan-teknologi'],
            ['name' => 'Manajemen Proyek Lintas Sektor', 'slug' => 'manajemen-proyek-lintas-sektor'],
            ['name' => 'Kebijakan Publik Berbasis Data', 'slug' => 'kebijakan-publik-berbasis-data'],
            ['name' => 'Tata Kelola Perusahaan', 'slug' => 'tata-kelola-perusahaan'],
            ['name' => 'Pengawasan Strategis', 'slug' => 'pengawasan-strategis'],
            ['name' => 'Pengelolaan Risiko', 'slug' => 'pengelolaan-risiko'],
            ['name' => 'Pengembangan Kelembagaan', 'slug' => 'pengembangan-kelembagaan'],
            ['name' => 'Ahli K3 PAPA', 'slug' => 'ahli-k3-papa'],
            ['name' => 'Inspeksi & Pengujian Keselamatan Kerja', 'slug' => 'inspeksi-pengujian-keselamatan-kerja'],
            ['name' => 'Manajemen Proyek Teknis', 'slug' => 'manajemen-proyek-teknis'],
            ['name' => 'Penerapan Standar Keselamatan Kerja', 'slug' => 'penerapan-standar-keselamatan-kerja'],
        ];

        foreach ($skills as $data) {
            Skill::firstOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}

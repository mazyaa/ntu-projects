<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Kajian Kebijakan Keselamatan Kerja',
                'slug' => 'kajian-kebijakan-keselamatan-kerja',
                'client_name' => 'Kementerian Ketenagakerjaan RI',
                'location' => 'Jakarta',
                'year' => '2024',
                'description' => 'Kajian kebijakan keselamatan kerja untuk penguatan regulasi dan implementasi norma K3 di sektor industri.',
                'category' => 'Kebijakan Publik',
                'title_en' => 'Occupational Safety Policy Study',
                'description_en' => 'Policy study on occupational safety for strengthening regulations and K3 norms implementation in the industrial sector.',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Survey Dampak Sosial Ekonomi Industri',
                'slug' => 'survey-dampak-sosial-ekonomi-industri',
                'client_name' => 'EU & ILO',
                'location' => 'Jawa Timur',
                'year' => '2023',
                'description' => 'Survey dampak sosial ekonomi kawasan industri terhadap komunitas pekerja dan sekitarnya.',
                'category' => 'Riset',
                'title_en' => 'Socio-Economic Impact Survey of Industrial Areas',
                'description_en' => 'Survey on the socio-economic impact of industrial areas on workers and surrounding communities.',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Implementasi SDGs di Kawasan Industri',
                'slug' => 'implementasi-sdgs-di-kawasan-industri',
                'client_name' => 'UNDP & Bappenas',
                'location' => 'Nasional',
                'year' => '2022',
                'description' => 'Kajian implementasi Sustainable Development Goals di kawasan industri nasional.',
                'category' => 'Sustainability',
                'title_en' => 'SDGs Implementation in Industrial Areas',
                'description_en' => 'Study on Sustainable Development Goals implementation in national industrial areas.',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Penyusunan Pedoman K3 Pesawat Angkat',
                'slug' => 'penyusunan-pedoman-k3-pesawat-angkat',
                'client_name' => 'Kementerian Ketenagakerjaan RI',
                'location' => 'Jakarta',
                'year' => '2022',
                'description' => 'Penyusunan pedoman teknis keselamatan kerja untuk pesawat angkat dan pesawat angkut.',
                'category' => 'K3',
                'title_en' => 'Development of Lifting Equipment Safety Guidelines',
                'description_en' => 'Development of technical occupational safety guidelines for lifting and transporting equipment.',
                'is_featured' => false,
                'is_published' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($projects as $data) {
            Project::firstOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\TeamMember;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'name' => 'Syarif Hidayat, Ph.D.',
                'slug' => 'syarif-hidayat',
                'position' => 'Direktur / Ketua Tim Tenaga Ahli',
                'position_en' => 'Director / Team Leader of Experts',
                'short_bio' => 'Direktur PT Nusantara Techno Utama sekaligus pemegang saham perseroan.',
                'short_bio_en' => 'Director of PT Nusantara Techno Utama and a shareholder of the company.',
                'bio' => 'Direktur PT Nusantara Techno Utama sekaligus pemegang saham perseroan, yang bertanggung jawab dalam menetapkan arah strategis perusahaan, mengembangkan kolaborasi dengan berbagai pemangku kepentingan, serta memastikan seluruh kegiatan operasional berjalan sesuai dengan prinsip tata kelola perusahaan yang baik (Good Corporate Governance). Meraih gelar Doctor of Philosophy (Ph.D.) dan memiliki pengalaman lebih dari 10 tahun dalam bidang riset terapan, pengembangan teknologi, manajemen proyek, serta penyusunan kajian strategis yang mendukung pengambilan keputusan berbasis data (evidence-based decision making).',
                'bio_en' => 'Director of PT Nusantara Techno Utama and a shareholder of the company, responsible for setting the company\'s strategic direction, developing collaboration with various stakeholders, and ensuring that all operational activities run in accordance with the principles of Good Corporate Governance. Holds a Doctor of Philosophy (Ph.D.) degree and has more than 10 years of experience in applied research, technology development, project management, and the formulation of strategic studies that support evidence-based decision making.',
                'photo' => 'images/team/001syarif.webp',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
                'skills' => ['Riset Terapan', 'Pengembangan Teknologi', 'Manajemen Proyek Lintas Sektor', 'Kebijakan Publik Berbasis Data'],
            ],
            [
                'name' => 'Fitriyah, M.Si.',
                'slug' => 'fitriyah',
                'position' => 'Komisaris',
                'position_en' => 'Commissioner',
                'short_bio' => 'Komisaris NTU dan pemegang saham mayoritas perseroan dengan kompetensi di bidang analisis ilmiah, tata kelola perusahaan, pengembangan kelembagaan.',
                'short_bio_en' => 'Commissioner of NTU and majority shareholder of the company, with competencies in scientific analysis, corporate governance, and institutional development.',
                'bio' => 'Komisaris PT Nusantara Techno Utama sekaligus pemegang saham mayoritas perseroan. Berlatar belakang pendidikan Magister Sains (M.Si.), memiliki kompetensi di bidang analisis ilmiah, tata kelola perusahaan (corporate governance), pengembangan kelembagaan, serta penguatan sistem manajemen organisasi.',
                'bio_en' => 'Commissioner of PT Nusantara Techno Utama and majority shareholder of the company. With a Master of Science (M.Si.) educational background, has competencies in scientific analysis, corporate governance, institutional development, and the strengthening of organizational management systems.',
                'photo' => 'images/team/005bupipit.webp',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
                'skills' => ['Tata Kelola Perusahaan', 'Pengawasan Strategis', 'Pengelolaan Risiko', 'Pengembangan Kelembagaan'],
            ],
            [
                'name' => 'Akhmad Munandar Prio Sudarma, S.T.',
                'slug' => 'akhmad',
                'position' => 'Manager Teknis',
                'position_en' => 'Technical Manager',
                'short_bio' => 'Memimpin tim teknis dalam kegiatan inspeksi, pengujian, dan penerapan keselamatan kerja pada proyek-proyek.',
                'short_bio_en' => 'Leads the technical team in inspection, testing, and the implementation of work safety on projects.',
                'bio' => 'Berpengalaman sebagai Ahli K3 Pesawat Angkat dan Pesawat Angkut (PAPA) dengan rekam jejak lebih dari delapan tahun sebagai Technical Expert pada perusahaan jasa keselamatan dan kesehatan kerja (PJK3). Memiliki kompetensi di bidang inspeksi teknis, pengujian, serta penerapan norma Keselamatan dan Kesehatan Kerja (K3).',
                'bio_en' => 'Experienced as an OHS Expert for Lifting and Transporting Equipment with more than eight years of track record as a Technical Expert in occupational safety and health (PJK3) service companies. Has competencies in technical inspection, testing, and the implementation of Occupational Safety and Health (OHS) norms.',
                'photo' => 'images/team/006akhmad.webp',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
                'skills' => ['Ahli K3 PAPA', 'Inspeksi & Pengujian Keselamatan Kerja', 'Manajemen Proyek Teknis', 'Penerapan Standar Keselamatan Kerja'],
            ],
        ];

        foreach ($members as $memberData) {
            $skillNames = $memberData['skills'] ?? [];
            unset($memberData['skills']);

            $member = TeamMember::firstOrCreate(
                ['slug' => $memberData['slug']],
                $memberData
            );

            foreach ($skillNames as $skillName) {
                $skill = Skill::firstOrCreate(
                    ['name' => $skillName],
                    ['slug' => Str::slug($skillName)]
                );
                $member->skills()->syncWithoutDetaching([$skill->id]);
            }
        }
    }
}

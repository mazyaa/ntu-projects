<?php

namespace Database\Seeders;

use App\Models\RiksaUjiCategory;
use App\Models\RiksaUjiType;
use Illuminate\Database\Seeder;

class RiksaUjiCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Pesawat Angkat & Angkut',
                'slug' => 'pesawat-angkat-angkut',
                'description' => 'Pemeriksaan dan pengujian berbagai jenis pesawat angkat dan pesawat angkut untuk memastikan keselamatan operasional.',
                'icon' => 'crane',
                'name_en' => 'Lifting & Transporting Equipment',
                'description_en' => 'Inspection and testing of various types of lifting and transporting equipment to ensure operational safety.',
                'is_active' => true,
                'sort_order' => 1,
                'types' => [
                    ['name' => 'Crane', 'slug' => 'crane', 'name_en' => 'Crane', 'sort_order' => 1],
                    ['name' => 'Overhead Crane', 'slug' => 'overhead-crane', 'name_en' => 'Overhead Crane', 'sort_order' => 2],
                    ['name' => 'Mobile Crane', 'slug' => 'mobile-crane', 'name_en' => 'Mobile Crane', 'sort_order' => 3],
                    ['name' => 'Tower Crane', 'slug' => 'tower-crane', 'name_en' => 'Tower Crane', 'sort_order' => 4],
                    ['name' => 'Jib Crane', 'slug' => 'jib-crane', 'name_en' => 'Jib Crane', 'sort_order' => 5],
                    ['name' => 'Gantry Crane', 'slug' => 'gantry-crane', 'name_en' => 'Gantry Crane', 'sort_order' => 6],
                    ['name' => 'Forklift', 'slug' => 'forklift', 'name_en' => 'Forklift', 'sort_order' => 7],
                    ['name' => 'Reach Stacker', 'slug' => 'reach-stacker', 'name_en' => 'Reach Stacker', 'sort_order' => 8],
                    ['name' => 'Telehandler', 'slug' => 'telehandler', 'name_en' => 'Telehandler', 'sort_order' => 9],
                    ['name' => 'Manlift', 'slug' => 'manlift', 'name_en' => 'Manlift', 'sort_order' => 10],
                    ['name' => 'Scissor Lift', 'slug' => 'scissor-lift', 'name_en' => 'Scissor Lift', 'sort_order' => 11],
                    ['name' => 'Hoist', 'slug' => 'hoist', 'name_en' => 'Hoist', 'sort_order' => 12],
                    ['name' => 'Dongkrak', 'slug' => 'dongkrak', 'name_en' => 'Jack', 'sort_order' => 13],
                    ['name' => 'Lainnya', 'slug' => 'lainnya-pesawat-angkat', 'name_en' => 'Other', 'sort_order' => 99],
                ],
            ],
            [
                'name' => 'Pesawat Tenaga & Produksi',
                'slug' => 'pesawat-tenaga-dan-produksi',
                'description' => 'Pemeriksaan dan pengujian pesawat tenaga dan pesawat produksi.',
                'icon' => 'cog',
                'name_en' => 'Power & Production Equipment',
                'description_en' => 'Inspection and testing of power and production equipment.',
                'is_active' => true,
                'sort_order' => 2,
                'types' => [],
            ],
            [
                'name' => 'Pesawat Uap',
                'slug' => 'pesawat-uap',
                'description' => 'Pemeriksaan dan pengujian pesawat uap (boiler).',
                'icon' => 'flame',
                'name_en' => 'Steam Boilers',
                'description_en' => 'Inspection and testing of steam boilers.',
                'is_active' => true,
                'sort_order' => 3,
                'types' => [],
            ],
            [
                'name' => 'Bejana Tekanan',
                'slug' => 'bejana-tekanan',
                'description' => 'Pemeriksaan dan pengujian bejana tekan (pressure vessel).',
                'icon' => 'container',
                'name_en' => 'Pressure Vessels',
                'description_en' => 'Inspection and testing of pressure vessels.',
                'is_active' => true,
                'sort_order' => 4,
                'types' => [],
            ],
            [
                'name' => 'Tangki Timbun',
                'slug' => 'tangki-timbun',
                'description' => 'Pemeriksaan dan pengujian tangki timbun (storage tank).',
                'icon' => 'database',
                'name_en' => 'Storage Tanks',
                'description_en' => 'Inspection and testing of storage tanks.',
                'is_active' => true,
                'sort_order' => 5,
                'types' => [],
            ],
            [
                'name' => 'Elevator & Eskalator',
                'slug' => 'elevator-eskalator',
                'description' => 'Pemeriksaan dan pengujian elevator dan eskalator.',
                'icon' => 'arrow-up-down',
                'name_en' => 'Elevators & Escalators',
                'description_en' => 'Inspection and testing of elevators and escalators.',
                'is_active' => true,
                'sort_order' => 6,
                'types' => [],
            ],
            [
                'name' => 'Instalasi Listrik',
                'slug' => 'instalasi-listrik',
                'description' => 'Pemeriksaan dan pengujian instalasi listrik.',
                'icon' => 'zap',
                'name_en' => 'Electrical Installations',
                'description_en' => 'Inspection and testing of electrical installations.',
                'is_active' => true,
                'sort_order' => 7,
                'types' => [],
            ],
            [
                'name' => 'Proteksi Kebakaran',
                'slug' => 'proteksi-kebakaran',
                'description' => 'Pemeriksaan dan pengujian sistem proteksi kebakaran.',
                'icon' => 'flame',
                'name_en' => 'Fire Protection',
                'description_en' => 'Inspection and testing of fire protection systems.',
                'is_active' => true,
                'sort_order' => 8,
                'types' => [],
            ],
        ];

        foreach ($categories as $categoryData) {
            $types = $categoryData['types'] ?? [];
            unset($categoryData['types']);

            $category = RiksaUjiCategory::firstOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );

            foreach ($types as $typeData) {
                $typeData['category_id'] = $category->id;
                $typeData['description'] = null;
                $typeData['description_en'] = null;
                $typeData['is_active'] = true;

                RiksaUjiType::firstOrCreate(
                    ['slug' => $typeData['slug']],
                    $typeData
                );
            }
        }
    }
}

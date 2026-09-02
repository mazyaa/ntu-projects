<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    public function run(): void
    {
        $equipment = [
            [
                'name' => 'Load Cell',
                'slug' => 'load-cell',
                'category' => 'Pengukuran',
                'description' => 'Pengukuran beban dan gaya',
                'name_en' => 'Load Cell',
                'description_en' => 'Load and force measurement',
                'image' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800&h=450&fit=crop',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Dye Penetrant Test (DPT)',
                'slug' => 'dye-penetrant-test',
                'category' => 'NDT',
                'description' => 'Deteksi retakan permukaan',
                'name_en' => 'Dye Penetrant Test (DPT)',
                'description_en' => 'Surface crack detection',
                'image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800&h=450&fit=crop',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Magnetic Particle Inspection',
                'slug' => 'magnetic-particle-inspection',
                'category' => 'NDT',
                'description' => 'Deteksi cacat permukaan pada material feromagnetik',
                'name_en' => 'Magnetic Particle Inspection',
                'description_en' => 'Surface defect detection on ferromagnetic materials',
                'image' => 'https://images.unsplash.com/photo-1581092162384-8987c1d64718?w=800&h=450&fit=crop',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Wire Rope Tester',
                'slug' => 'wire-rope-tester',
                'category' => 'Pengujian',
                'description' => 'Pengujian kawat baja tali',
                'name_en' => 'Wire Rope Tester',
                'description_en' => 'Steel wire rope testing',
                'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&h=450&fit=crop',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Insulation Tester',
                'slug' => 'insulation-tester',
                'category' => 'Listrik',
                'description' => 'Pengujian isolasi listrik',
                'name_en' => 'Insulation Tester',
                'description_en' => 'Electrical insulation testing',
                'image' => 'https://images.unsplash.com/photo-1621905252507-b35492cc74b4?w=800&h=450&fit=crop',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Multimeter',
                'slug' => 'multimeter',
                'category' => 'Listrik',
                'description' => 'Pengukuran listrik parameter',
                'name_en' => 'Multimeter',
                'description_en' => 'Electrical parameter measurement',
                'image' => 'https://images.unsplash.com/photo-1592496431122-2349e0fbc666?w=800&h=450&fit=crop',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'Laser Meter',
                'slug' => 'laser-meter',
                'category' => 'Pengukuran',
                'description' => 'Pengukuran jarak presisi',
                'name_en' => 'Laser Meter',
                'description_en' => 'Precision distance measurement',
                'image' => 'https://images.unsplash.com/photo-1572981779307-38b8cabb2407?w=800&h=450&fit=crop',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'name' => 'Calibrated Tools',
                'slug' => 'calibrated-tools',
                'category' => 'Peralatan Pendukung',
                'description' => 'Peralatan terkalibrasi untuk pengujian',
                'name_en' => 'Calibrated Tools',
                'description_en' => 'Calibrated equipment for testing',
                'image' => 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=800&h=450&fit=crop',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 8,
            ],
        ];

        foreach ($equipment as $data) {
            Equipment::firstOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}

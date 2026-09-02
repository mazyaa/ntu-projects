<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServicesTabSeeder extends Seeder
{
    public function run(): void
    {
        $riksaUji = [
            ['name' => 'Riksa Uji Dongkrak', 'desc' => 'Dongkrak hidraulik, pneumatik, post lift, truck/car lift, serta peralatan sejenis lainnya.', 'image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800&h=450&fit=crop'],
            ['name' => 'Riksa Uji Crane', 'desc' => 'Overhead crane, hoist crane, monorail crane, jib crane, gantry crane, mobile crane, crawler crane, tower crane, dan lainnya.', 'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&h=450&fit=crop'],
            ['name' => 'Riksa Uji Alat Angkat Pengatur Posisi', 'desc' => 'Rotator, peralatan robotik, takel, serta peralatan sejenis lainnya.', 'image' => 'https://images.unsplash.com/photo-1565043666747-69f6646db940?w=800&h=450&fit=crop'],
            ['name' => 'Riksa Uji Personal Platform', 'desc' => 'Passenger hoist, gondola, serta peralatan sejenis lainnya.', 'image' => 'https://images.unsplash.com/photo-1517089596392-fb9a9033e05b?w=800&h=450&fit=crop'],
            ['name' => 'Riksa Uji Alat Berat', 'desc' => 'Forklift, reach stacker, telehandler, excavator, backhoe, loader, dozer, dan lainnya.', 'image' => 'https://images.unsplash.com/photo-1581092162384-8987c1d64718?w=800&h=450&fit=crop'],
            ['name' => 'Riksa Uji Kereta', 'desc' => 'Kereta gantung, komidi putar, roller coaster, lokomotif beserta rangkaiannya.', 'image' => 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=800&h=450&fit=crop'],
            ['name' => 'Riksa Uji Personal Basket', 'desc' => 'Manlift/boom lift, scissor lift, hydraulic stairs, serta peralatan sejenis lainnya.', 'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&h=450&fit=crop'],
            ['name' => 'Riksa Uji Truk & Trailer', 'desc' => 'Tractor, dump truck, cargo truck lift, trailer, side loader truck, module transporter.', 'image' => 'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?w=800&h=450&fit=crop'],
            ['name' => 'Riksa Uji Robotik & Konveyor', 'desc' => 'Automated Guided Vehicle, sabuk berjalan, ban berjalan, rantai berjalan.', 'image' => 'https://images.unsplash.com/photo-1565043666747-69f6646db940?w=800&h=450&fit=crop'],
            ['name' => 'Riksa Uji Alat Bantu Angkat & Angkut', 'desc' => 'Sling, spreader bar, lifting beam, personal basket, shackle, tumbuckle, hook, master link.', 'image' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800&h=450&fit=crop'],
        ];

        $konsultasi = [
            ['name' => 'Konsultasi Lingkungan', 'desc' => 'Membantu perusahaan memenuhi kewajiban regulasi lingkungan, meningkatkan kinerja lingkungan, serta mendukung implementasi ESG dan sustainability.', 'image' => 'https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=800&h=450&fit=crop'],
            ['name' => 'Surat Laik Operasi IPAL', 'desc' => 'Membantu mengatasi kendala IPAL menuju operasi yang legal, efektif, dan berkelanjutan.', 'image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800&h=450&fit=crop'],
            ['name' => 'Konsultasi Pertek IPAL', 'desc' => 'Membantu IPAL yang gagal uji menjadi sistem yang memenuhi standar dan siap memperoleh izin.', 'image' => 'https://images.unsplash.com/photo-1581092162384-8987c1d64718?w=800&h=450&fit=crop'],
            ['name' => 'Konsultasi Pertek Emisi', 'desc' => 'Membantu mengatasi masalah pencemaran dan memastikan emisi memenuhi baku mutu.', 'image' => 'https://images.unsplash.com/photo-1611273426858-450d8e3c9fce?w=800&h=450&fit=crop'],
            ['name' => 'Konsultasi Pertek Pengelolaan Limbah B3', 'desc' => 'Membantu mengatasi masalah limbah B3 dan memastikan pengelolaannya sesuai ketentuan.', 'image' => 'https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=800&h=450&fit=crop'],
            ['name' => 'Water & Wastewater Management', 'desc' => 'IPAL, Monitoring Air Limbah, Sampling Air untuk pengelolaan limbah sistematis dan terpadu.', 'image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800&h=450&fit=crop'],
        ];

        $perizinan = [
            ['name' => 'AMDAL', 'desc' => 'Analisis Mengenai Dampak Lingkungan untuk rencana usaha berskala besar.', 'image' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=800&h=450&fit=crop'],
            ['name' => 'UKL-UPL', 'desc' => 'Upaya Pengelolaan Lingkungan – Upaya Pemantauan Lingkungan.', 'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&h=450&fit=crop'],
            ['name' => 'DELH', 'desc' => 'Dokumen Evaluasi Lingkungan Hidup untuk kegiatan eksisting.', 'image' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=800&h=450&fit=crop'],
            ['name' => 'DPLH', 'desc' => 'Dokumen Pengelolaan Lingkungan Hidup untuk inventarisasi dampak lingkungan.', 'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&h=450&fit=crop'],
            ['name' => 'RKL-RPL', 'desc' => 'Rencana Pengelolaan Lingkungan – Rencana Pemantauan Lingkungan.', 'image' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=800&h=450&fit=crop'],
        ];

        $sortOrder = 0;

        foreach ($riksaUji as $item) {
            Service::updateOrCreate(
                ['slug' => Str::slug($item['name'])],
                [
                    'title' => $item['name'],
                    'description' => $item['desc'],
                    'image' => $item['image'],
                    'category' => 'riksa_uji',
                    'icon' => 'shield-check',
                    'color' => 'primary',
                    'status' => 'active',
                    'is_active' => true,
                    'sort_order' => $sortOrder++,
                ]
            );
        }

        foreach ($konsultasi as $item) {
            Service::updateOrCreate(
                ['slug' => Str::slug($item['name'])],
                [
                    'title' => $item['name'],
                    'description' => $item['desc'],
                    'image' => $item['image'],
                    'category' => 'konsultasi',
                    'icon' => 'message-square',
                    'color' => 'accent',
                    'status' => 'active',
                    'is_active' => true,
                    'sort_order' => $sortOrder++,
                ]
            );
        }

        foreach ($perizinan as $item) {
            Service::updateOrCreate(
                ['slug' => Str::slug($item['name'])],
                [
                    'title' => $item['name'],
                    'description' => $item['desc'],
                    'image' => $item['image'],
                    'category' => 'perizinan',
                    'icon' => 'file-check',
                    'color' => 'success',
                    'status' => 'active',
                    'is_active' => true,
                    'sort_order' => $sortOrder++,
                ]
            );
        }
    }
}

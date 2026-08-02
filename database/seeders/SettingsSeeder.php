<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Default site settings. Values are env-aware where applicable.
     */
    private const DEFAULTS = [
        ['group' => 'general', 'key' => 'site_name', 'label' => 'Nama Situs', 'type' => 'string', 'value' => 'PT Nusantara Techno Utama'],
        ['group' => 'general', 'key' => 'site_tagline', 'label' => 'Tagline', 'type' => 'textarea', 'value' => 'Mitra Riset dan Teknologi Terpercaya untuk Indonesia yang Berkelanjutan'],
        ['group' => 'general', 'key' => 'contact_email', 'label' => 'Email Kontak Utama', 'type' => 'string', 'value' => 'info@techno-inovation.com'],
        ['group' => 'general', 'key' => 'contact_phone', 'label' => 'Telepon', 'type' => 'string', 'value' => '+62 8180 7138 156'],
        ['group' => 'general', 'key' => 'contact_address', 'label' => 'Alamat', 'type' => 'textarea', 'value' => 'Komp. Nuansa Alam Banjar Estate Blok A7 No.2, RT 003/RW 004, Kel. Banjar Agung, Kec. Cipocok Jaya, Kota Serang, Provinsi Banten'],
        ['group' => 'general', 'key' => 'inbox_notify_email', 'label' => 'Email Notifikasi Inbox', 'type' => 'string', 'value' => ''],
        ['group' => 'maintenance', 'key' => 'enabled', 'label' => 'Mode Maintenance Publik', 'type' => 'boolean', 'value' => '0'],
        ['group' => 'analytics', 'key' => 'unique_visit_window_hours', 'label' => 'Jendela Dedup Kunjungan (jam)', 'type' => 'integer', 'value' => '24'],
        ['group' => 'seo', 'key' => 'default_meta_title', 'label' => 'Meta Title Default', 'type' => 'string', 'value' => 'PT Nusantara Techno Utama'],
        ['group' => 'seo', 'key' => 'default_meta_description', 'label' => 'Meta Description Default', 'type' => 'textarea', 'value' => 'Mitra riset dan teknologi terpercaya untuk Indonesia yang berkelanjutan.'],
    ];

    public function run(): void
    {
        foreach (self::DEFAULTS as $item) {
            if ($item['group'] === 'general' && $item['key'] === 'inbox_notify_email') {
                $item['value'] = (string) env('MAIL_TO_ADDRESS', '');
            }

            Setting::updateOrCreate(
                ['group' => $item['group'], 'key' => $item['key']],
                [
                    'value' => $item['value'],
                    'type' => $item['type'],
                    'label' => $item['label'],
                ],
            );
        }
    }
}

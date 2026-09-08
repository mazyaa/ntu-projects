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
        ['group' => 'general', 'key' => 'site_name', 'label' => 'Nama Situs', 'type' => 'string', 'value_fn' => 'appName'],
        ['group' => 'general', 'key' => 'site_tagline', 'label' => 'Tagline', 'type' => 'textarea', 'value_fn' => 'siteTagline'],
        ['group' => 'general', 'key' => 'contact_email', 'label' => 'Email Kontak Utama', 'type' => 'string', 'value_fn' => 'contactEmail'],
        ['group' => 'general', 'key' => 'contact_phone', 'label' => 'Telepon', 'type' => 'string', 'value_fn' => 'contactPhone'],
        ['group' => 'general', 'key' => 'contact_address', 'label' => 'Alamat', 'type' => 'textarea', 'value_fn' => 'contactAddress'],
        ['group' => 'general', 'key' => 'inbox_notify_email', 'label' => 'Email Notifikasi Inbox', 'type' => 'string', 'value_fn' => 'inboxEmail'],
        ['group' => 'maintenance', 'key' => 'enabled', 'label' => 'Mode Maintenance Publik', 'type' => 'boolean', 'value' => '0'],
        ['group' => 'analytics', 'key' => 'unique_visit_window_hours', 'label' => 'Jendela Dedup Kunjungan (jam)', 'type' => 'integer', 'value' => '24'],
        ['group' => 'seo', 'key' => 'default_meta_title', 'label' => 'Meta Title Default', 'type' => 'string', 'value_fn' => 'appName'],
        ['group' => 'seo', 'key' => 'default_meta_description', 'label' => 'Meta Description Default', 'type' => 'textarea', 'value_fn' => 'metaDescription'],
    ];

    public function run(): void
    {
        foreach (self::DEFAULTS as $item) {
            $value = $item['value'] ?? $this->resolveValue($item['value_fn'] ?? null);

            Setting::updateOrCreate(
                ['group' => $item['group'], 'key' => $item['key']],
                [
                    'value' => $value,
                    'type' => $item['type'],
                    'label' => $item['label'],
                ],
            );
        }
    }

    private function resolveValue(?string $fn): string
    {
        return match ($fn) {
            'appName' => config('app.name', 'PT Nusantara Techno Utama'),
            'siteTagline' => env('SITE_TAGLINE', 'Mitra Riset dan Teknologi Terpercaya untuk Indonesia yang Berkelanjutan'),
            'contactEmail' => env('CONTACT_EMAIL', 'info@techno-innovation.com'),
            'contactPhone' => env('CONTACT_PHONE', '+62 8180 7138 156'),
            'contactAddress' => env('CONTACT_ADDRESS', 'Komp. Nuansa Alam Banjar Estate Blok A7 No.2, RT 003/RW 004, Kel. Banjar Agung, Kec. Cipocok Jaya, Kota Serang, Provinsi Banten'),
            'inboxEmail' => env('MAIL_TO_ADDRESS', ''),
            'metaDescription' => env('DEFAULT_META_DESCRIPTION', 'Mitra riset dan teknologi terpercaya untuk Indonesia yang berkelanjutan.'),
            default => '',
        };
    }
}

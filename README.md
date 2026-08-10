<h1 align="center">PT Nusantara Techno Utama — Company Website</h1>

<p align="center">
  Situs web perusahaan resmi PT Nusantara Techno Utama (NTU): company profile, pilar layanan, riset &amp; kajian kebijakan, kepemimpinan, artikel, serta kontak — dengan dukungan <strong>dua bahasa (Indonesia &amp; Inggris)</strong> dan <strong>panel admin berbasis peran</strong>.
</p>

---

## Fitur

- **Situs publik bilingual** — konten statis via file `lang/{id,en}/company*.php`, konten dinamis (artikel, layanan, kategori, keahlian penulis) via kolom `*_en` di database.
- **URL dua bahasa** — situs Indonesia tanpa prefiks (kanonikal), versi Inggris di `/en/...` dengan `slug_en` terpisah dan fallback ke slug Indonesia.
- **Panel admin** — `/admin` untuk Super Admin/Admin dan `/editor` untuk Editor, dengan otorisasi berbasis peran &amp; izin (Spatie Laravel Permission).
- **Manajemen konten** — artikel (penjadwalan, draft/published, featured, kategori, tag, rich editor), layanan, kategori, tag, dan media.
- **Kotak masuk kontak** — formulir publik tersimpan ke inbox yang dikelola dari admin.
- **Pengaturan &amp; SEO** — pengaturan situs dan metadata SEO.
- **Keamanan** — header keamanan (HSTS, frame options), deteksi secret di pre-commit, dan validasi role/permission di tiap route admin.

## Teknologi

| Lapisan | Teknologi |
| --- | --- |
| Backend | Laravel 13 (PHP 8.4) |
| Frontend | Blade, Tailwind CSS 4, Alpine.js |
| Aset | Vite (laravel-vite-plugin) |
| Animasi & UI | AOS, GSAP, Lenis, Swiper, ApexCharts, CountUp, Typed.js, Lucide, Notyf, SweetAlert2 |
| Database | MySQL (default) / SQLite |
| Cache & Analytics | Redis |
| Autentikasi | Laravel Breeze |
| Otorisasi | spatie/laravel-permission |
| Kualitas | Laravel Pint, Pest, husky + lint-staged |

## Persyaratan

- PHP ^8.4
- Composer
- Node.js 22.x
- MySQL atau SQLite
- Redis (opsional, untuk cache/analytics)

## Instalasi

```bash
# 1. Install dependensi & setup lingkungan (membuat .env, key, migrate, build aset)
composer setup

# atau manual:
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
```

## Menjalankan Aplikasi

Mode pengembangan (server, queue, log, dan Vite sekaligus):

```bash
composer dev
```

Secara terpisah:

```bash
php artisan serve        # http://localhost:8000
npm run dev              # Vite hot-reload
```

## Seeder & Akun Admin

Jalankan seeder untuk membuat role/izin, akun admin, pengaturan, konten, dan konten berbahasa Inggris:

```bash
php artisan db:seed
```

Akun default Super Admin diambil dari variabel env (seeder tidak pernah meng-hardcode secret):

```env
ADMIN_NAME="Super Admin"
ADMIN_EMAIL="admin@test.com"
ADMIN_PASSWORD="change-me"
```

> Ganti `ADMIN_PASSWORD` sebelum deployment.

### Role bawaan

- **Super Admin** — seluruh izin.
- **Admin** — layanan, media, kategori, tag, kontak, SEO, analytics, log aktivitas, pengaturan.
- **Editor** — artikel (buat/ubah/publish/arsip), media, lihat kategori & tag.

## Sistem Bilingual

- Situs publik Indonesia adalah kanonikal (tanpa prefiks). Versi Inggris tersedia di `/en/...` melalui middleware `locale` dan helper `lroute()`.
- Konten statis dikelola lewat `lang/{id,en}/company*.php`, `lang/{id,en}/ui.php`.
- Konten dinamis (artikel, layanan, kategori, keahlian penulis) menyimpan terjemahan pada kolom `*_en` (mis. `title_en`, `content_en`, `slug_en`).
- Trait `App\Support\Localizable` menyediakan `localized($field)` dan `routeSlug()`: menampilkan nilai Inggris bila ada, dan jatuh kembali (fallback) ke nilai Indonesia bila belum diterjemahkan.
- Backfill terjemahan Inggris dari `lang/en/company-*.php` dilakukan oleh `EnglishContentSeeder` (idempotent, aman dijalankan ulang).

## Optimasi Gambar

Lag saat scroll (khususnya section services) umumnya berasal dari **jumlah piksel gambar saat di-decode**, bukan ukuran file. Solusi memakai `intervention/image` (driver GD + WebP):

- **Resize statis** — `php artisan images:optimize` men-downscale & re-encode gambar ke ukuran tampilan ×2 (services 800×450, hero 1920×1080, about 1200×1500, media 1600px). Idempotent; ada opsi `--path=` dan `--dry-run`.
- **Auto-resize saat upload** — upload gambar dari admin (media library, gambar/thumbnail artikel) otomatis dikonversi ke WebP dan dibatasi lebar maksimal 1600px oleh `App\Services\ImageOptimizerService`.
- **HTML** — tag `<img>` service/hero/about diberi `width`/`height` (anti layout shift), `decoding="async"`, dan `fetchpriority="high"` pada hero.
- **CSS** — `backdrop-filter` di `.glass-card` diperingan + utilitas `.cv-auto` (`content-visibility: auto`) pada section services agar konten di luar layar tidak di-render saat scroll.
- Docker image produksi menyertakan extension `gd` dengan dukungan WebP.

## Struktur Folder

```
app/
  Http/Controllers/       # SiteController (publik), ContactController, Auth, Admin/*
  Http/Middleware/        # SetLocale, SecurityHeaders, CheckMaintenance, EnsureAdminAuthenticated, ...
  Http/Requests/          # FormRequest termasuk Admin/ArticleRequest
  Models/                 # Article, Category, Tag, Service, Media, User, ...
  Support/Localizable.php # Trait bantuan terjemahan
bootstrap/app.php         # Registrasi middleware, alias, & group route admin
config/company*.php       # Data profil perusahaan (default)
database/
  migrations/             # Skema database
  seeders/                # Role/permission, admin, pengaturan, konten, konten EN
lang/{id,en}/             # Terjemahan statis
resources/views/
  pages/                  # Halaman publik (tentang, layanan, riset, artikel, kontak)
  components/landing/     # Komponen landing page
  admin/                  # Panel admin
  layouts/                # layout landing & admin
routes/
  web.php                 # Route publik (ID + EN)
  admin.php               # Route panel (/admin & /editor)
  auth.php                # Route autentikasi
scripts/                  # check-secrets.mjs, check-tailwind.mjs
```

## Lint & Kualitas

```bash
npm run lint              # secret check + Pint + Tailwind check
php vendor/bin/pint       # perbaiki gaya kode secara otomatis
php artisan test          # jalankan test (Pest)
```

Pre-commit otomatis menjalankan `check-secrets` dan `lint-staged` (Pint) melalui husky.

## Testing

```bash
composer test
```

## Deployment

### Docker

```bash
docker build -t ntu-project .
docker run -p 8000:8000 --env-file .env ntu-project
```

`Dockerfile` multi-stage membangun aset frontend (Node 22) dan dependensi backend (PHP 8.4), lalu menjalankan entrypoint `docker-entrypoint.sh`. Health check tersedia di `/up`.

### Railway

Konfigurasi build & deploy Dockerfile sudah disiapkan pada `railway.json`.

## Lisensi

Proyek ini dikembangkan untuk keperluan internal PT Nusantara Techno Utama.

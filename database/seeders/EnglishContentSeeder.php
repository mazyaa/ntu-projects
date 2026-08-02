<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class EnglishContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedServices();
        $this->seedArticles();
        $this->seedCategories();
    }

    private function seedServices(): void
    {
        $translations = collect(Lang::get('company-services.categories', [], 'en'));

        $this->reconcileServiceSlugs($translations);

        foreach (Service::all() as $service) {
            $en = $translations->firstWhere('slug', $service->slug);

            if (! $en) {
                continue;
            }

            $service->update([
                'title_en' => $en['title'] ?? null,
                'short_title_en' => $en['short_title'] ?? null,
                'tagline_en' => $en['tagline'] ?? null,
                'description_en' => $en['description'] ?? null,
                'service_items_en' => $en['services'] ?? [],
                'slug_en' => $this->englishSlug($en['title'] ?? null),
            ]);
        }
    }

    /**
     * Align database service slugs with the canonical slugs used across the
     * config/lang content (some rows were created from the Indonesian title,
     * e.g. "perdagangan-jasa-penunjang" instead of "trading-support").
     */
    private function reconcileServiceSlugs(iterable $translations): void
    {
        $canonical = collect($translations)->pluck('slug')->filter()->all();
        $idSource = collect(Lang::get('company-services.categories', [], 'id'));

        foreach (Service::whereNotIn('slug', $canonical)->get() as $service) {
            $idEntry = $idSource->first(
                fn ($data) => Str::lower(trim((string) $data['title'])) === Str::lower(trim((string) $service->title))
            );

            if (! $idEntry) {
                continue;
            }

            $service->update(['slug' => $idEntry['slug']]);
        }
    }

    private function seedArticles(): void
    {
        $translations = collect(Lang::get('company-insights.articles', [], 'en'));

        foreach (Article::all() as $article) {
            $en = $translations->firstWhere('slug', $article->slug);

            if (! $en) {
                continue;
            }

            $article->update([
                'title_en' => $en['title'] ?? null,
                'excerpt_en' => $en['excerpt'] ?? null,
                'content_en' => $en['content'] ?? null,
                'slug_en' => $this->englishSlug($en['title'] ?? null),
            ]);
        }
    }

    private function seedCategories(): void
    {
        $names = [
            'Kebijakan Publik' => 'Public Policy',
            'Ketenagakerjaan' => 'Employment',
            'Jaminan Sosial' => 'Social Security',
            'Riset' => 'Research',
            'Teknologi' => 'Technology',
        ];

        foreach (Category::all() as $category) {
            $category->update([
                'name_en' => $names[$category->name] ?? null,
            ]);
        }
    }

    private function englishSlug(?string $title): ?string
    {
        if (blank($title)) {
            return null;
        }

        $slug = Str::slug($title);

        return blank($slug) ? null : $slug;
    }
}

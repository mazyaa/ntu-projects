<?php

namespace Database\Seeders;

use App\Enums\ArticleStatus;
use App\Models\Article;
use App\Models\Category;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedCategories();
        $this->seedServices();
        $this->seedArticles();
    }

    private function seedCategories(): void
    {
        $names = ['Kebijakan Publik', 'Ketenagakerjaan', 'Jaminan Sosial', 'Riset', 'Teknologi'];

        foreach ($names as $name) {
            Category::updateOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name)],
            );
        }
    }

    private function seedServices(): void
    {
        $categories = config('company-services.categories', []);

        foreach ($categories as $index => $data) {
            Service::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'title' => $data['title'],
                    'short_title' => $data['short_title'] ?? null,
                    'image' => $data['image'] ?? null,
                    'icon' => $data['icon'] ?? 'briefcase',
                    'color' => $data['color'] ?? 'primary',
                    'tagline' => $data['tagline'] ?? null,
                    'description' => $data['description'] ?? null,
                    'service_items' => $data['services'] ?? [],
                    'status' => 'active',
                    'sort_order' => $index + 1,
                ],
            );
        }
    }

    private function seedArticles(): void
    {
        $articles = config('company-insights.articles', []);
        $author = User::role('Super Admin')->first() ?? User::first();

        if (! $author) {
            return;
        }

        foreach ($articles as $index => $data) {
            $category = Category::where('name', $data['category'] ?? '')->first() ?? Category::first();

            Article::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'author_id' => $author->id,
                    'category_id' => $category?->id,
                    'title' => $data['title'],
                    'excerpt' => $data['excerpt'] ?? null,
                    'content' => $data['content'] ?? null,
                    'thumbnail' => $data['image'] ?? null,
                    'cover' => null,
                    'status' => ArticleStatus::Published,
                    'is_featured' => $index === 0,
                    'reading_time' => $this->readingTimeFromString($data['reading_time'] ?? '5 menit'),
                    'published_at' => now(),
                    'views_count' => 0,
                ],
            );
        }
    }

    private function readingTimeFromString(string $value): int
    {
        preg_match('/\d+/', $value, $matches);

        return $matches ? (int) $matches[0] : 5;
    }
}

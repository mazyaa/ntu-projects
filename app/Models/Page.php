<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'title_en',
        'content_en',
        'status',
        'seo_title',
        'seo_description',
        'canonical_url',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Get localized title based on current locale.
     */
    public function localizedTitle(): string
    {
        return app()->getLocale() === 'en' && $this->title_en
            ? $this->title_en
            : $this->title;
    }

    /**
     * Get localized content based on current locale.
     */
    public function localizedContent(): ?string
    {
        return app()->getLocale() === 'en' && $this->content_en
            ? $this->content_en
            : $this->content;
    }
}

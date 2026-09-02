<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamMember extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'position',
        'short_bio',
        'bio',
        'photo',
        'position_en',
        'short_bio_en',
        'bio_en',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'team_member_skill');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get the localized position based on current locale.
     */
    public function localizedPosition(): string
    {
        return app()->getLocale() === 'en' && $this->position_en
            ? $this->position_en
            : $this->position;
    }

    /**
     * Get the localized short bio based on current locale.
     */
    public function localizedShortBio(): ?string
    {
        return app()->getLocale() === 'en' && $this->short_bio_en
            ? $this->short_bio_en
            : $this->short_bio;
    }

    /**
     * Get the localized bio based on current locale.
     */
    public function localizedBio(): ?string
    {
        return app()->getLocale() === 'en' && $this->bio_en
            ? $this->bio_en
            : $this->bio;
    }
}

<?php

namespace App\Models;

use App\Enums\ServiceStatus;
use App\Support\Localizable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, HasUuids, Localizable, SoftDeletes;

    protected $fillable = [
        'slug', 'slug_en',
        'title', 'title_en',
        'short_title', 'short_title_en',
        'category',
        'image', 'icon', 'color',
        'tagline', 'tagline_en',
        'short_description', 'short_description_en',
        'description', 'description_en',
        'service_items', 'service_items_en',
        'status',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'service_items' => 'array',
            'service_items_en' => 'array',
            'sort_order' => 'integer',
            'status' => ServiceStatus::class,
            'is_active' => 'boolean',
        ];
    }

    public function seoMeta(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }

    public function scopeActive($query)
    {
        return $query->where('status', ServiceStatus::Active->value)
            ->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }
}

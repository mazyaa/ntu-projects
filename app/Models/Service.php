<?php

namespace App\Models;

use App\Enums\ServiceStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'slug',
        'title',
        'short_title',
        'image',
        'icon',
        'color',
        'tagline',
        'description',
        'service_items',
        'status',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'service_items' => 'array',
            'sort_order' => 'integer',
            'status' => ServiceStatus::class,
        ];
    }

    public function seoMeta(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }

    public function scopeActive($query)
    {
        return $query->where('status', ServiceStatus::Active->value);
    }
}

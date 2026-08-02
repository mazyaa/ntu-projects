<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SeoMeta extends Model
{
    use HasUuids;

    protected $table = 'seo_meta';

    protected $fillable = [
        'seoable_type',
        'seoable_id',
        'meta_title',
        'meta_description',
        'canonical_url',
        'robots',
        'og_title',
        'og_description',
        'og_image',
        'twitter_card',
        'schema',
    ];

    protected function casts(): array
    {
        return [
            'schema' => 'array',
        ];
    }

    public function seoable(): MorphTo
    {
        return $this->morphTo();
    }
}

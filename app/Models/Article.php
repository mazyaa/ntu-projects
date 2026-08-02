<?php

namespace App\Models;

use App\Enums\ArticleStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'thumbnail',
        'cover',
        'status',
        'is_featured',
        'reading_time',
        'published_at',
        'archived_at',
        'scheduled_at',
        'views_count',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'reading_time' => 'integer',
            'views_count' => 'integer',
            'published_at' => 'datetime',
            'archived_at' => 'datetime',
            'scheduled_at' => 'datetime',
            'status' => ArticleStatus::class,
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function seoMeta(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }

    public function views(): HasMany
    {
        return $this->hasMany(ArticleView::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', ArticleStatus::Published->value)
            ->whereNotNull('published_at');
    }
}

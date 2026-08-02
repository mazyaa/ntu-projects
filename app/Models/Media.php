<?php

namespace App\Models;

use App\Enums\MediaType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'media';

    protected $fillable = [
        'uploaded_by',
        'name',
        'original_name',
        'path',
        'mime_type',
        'size',
        'type',
        'disk',
        'alt_text',
    ];

    protected function casts(): array
    {
        return [
            'size' => 'integer',
            'type' => MediaType::class,
        ];
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function url(): string
    {
        return asset('storage/'.ltrim($this->path, '/'));
    }

    public function isImage(): bool
    {
        return $this->type === MediaType::Image;
    }
}

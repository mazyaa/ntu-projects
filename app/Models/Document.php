<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'file_path',
        'file_name',
        'mime_type',
        'file_size',
        'documentable_type',
        'documentable_id',
        'notes',
    ];

    public function documentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the public URL for the document.
     */
    public function url(): ?string
    {
        return $this->file_path ? asset('storage/'.ltrim($this->file_path, '/')) : null;
    }
}

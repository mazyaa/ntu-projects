<?php

namespace App\Models;

use App\Support\Localizable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory, HasUuids, Localizable;

    protected $fillable = [
        'name',
        'name_en',
        'slug',
        'description',
        'description_en',
    ];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}

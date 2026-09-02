<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'slug',
        'address',
        'province',
        'city',
        'district',
        'postal_code',
        'phone',
        'email',
        'nib',
        'npwp',
        'website',
    ];

    public function riksaUjiObjects(): HasMany
    {
        return $this->hasMany(RiksaUjiObject::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

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

    protected static function booted(): void
    {
        static::creating(function (Company $company) {
            if (empty($company->slug)) {
                $slug = Str::slug($company->name);
                $original = $slug;
                $count = 1;
                while (static::withoutGlobalScopes()->where('slug', $slug)->exists()) {
                    $slug = $original.'-'.$count++;
                }
                $company->slug = $slug;
            }
        });
    }

    public function riksaUjiObjects(): HasMany
    {
        return $this->hasMany(RiksaUjiObject::class);
    }

    public function customerProfiles(): HasMany
    {
        return $this->hasMany(CustomerProfile::class);
    }

    public function inspectionRequests(): HasMany
    {
        return $this->hasMany(InspectionRequest::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiksaUjiObject extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'company_id',
        'category_id',
        'type_id',
        'name',
        'brand',
        'model',
        'serial_number',
        'factory_number',
        'manufacture_year',
        'capacity',
        'capacity_unit',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(RiksaUjiCategory::class, 'category_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(RiksaUjiType::class, 'type_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InspectionRequestObject extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'inspection_request_id',
        'riksa_uji_object_id',
        'object_name',
        'category_id',
        'type_id',
        'brand',
        'model',
        'serial_number',
        'factory_number',
        'manufacture_year',
        'capacity',
        'capacity_unit',
        'has_previous_inspection',
        'previous_certificate_number',
        'previous_inspection_date',
        'certificate_expiry_date',
        'previous_pjk3',
    ];

    protected function casts(): array
    {
        return [
            'previous_inspection_date' => 'date',
            'certificate_expiry_date' => 'date',
            'has_previous_inspection' => 'boolean',
        ];
    }

    public function inspectionRequest(): BelongsTo
    {
        return $this->belongsTo(InspectionRequest::class);
    }

    public function riksaUjiObject(): BelongsTo
    {
        return $this->belongsTo(RiksaUjiObject::class);
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

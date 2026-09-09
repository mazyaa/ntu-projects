<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class InspectionRequest extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'request_number',
        'user_id',
        'company_id',
        'status',
        'applicant_name',
        'applicant_position',
        'applicant_phone',
        'applicant_email',
        'inspection_address',
        'inspection_province',
        'inspection_city',
        'inspection_district',
        'inspection_postal_code',
        'location_notes',
        'customer_notes',
        'has_previous_inspection',
        'previous_certificate_number',
        'previous_inspection_date',
        'certificate_expiry_date',
        'previous_pjk3',
        'submitted_at',
    ];

    protected function casts(): array
    {
        return [
            'submitted_at' => 'datetime',
            'previous_inspection_date' => 'date',
            'certificate_expiry_date' => 'date',
            'has_previous_inspection' => 'boolean',
        ];
    }

    /**
     * Generate a unique request number.
     * Format: RU-YYYYMMDD-XXXX
     */
    public static function generateRequestNumber(): string
    {
        $prefix = 'RU-'.now()->format('Ymd').'-';
        $last = static::where('request_number', 'like', $prefix.'%')
            ->orderByDesc('request_number')
            ->value('request_number');

        if ($last) {
            $sequence = (int) substr($last, -4) + 1;
        } else {
            $sequence = 1;
        }

        return $prefix.str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function objects(): HasMany
    {
        return $this->hasMany(InspectionRequestObject::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(RequestNote::class, 'inspection_request_id');
    }

    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}

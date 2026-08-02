<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasUuids;

    protected $fillable = [
        'group',
        'key',
        'value',
        'type',
        'label',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'string',
        ];
    }

    /**
     * Decode the stored value based on its declared type.
     */
    public function decodedValue(): mixed
    {
        return match ($this->type) {
            'boolean' => filter_var($this->value, FILTER_VALIDATE_BOOLEAN),
            'integer' => (int) $this->value,
            'json' => json_decode($this->value, true),
            default => $this->value,
        };
    }
}

<?php

namespace App\Enums;

enum ServiceStatus: string
{
    case Active = 'active';
    case Draft = 'draft';
    case Archived = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::Active => 'Active',
            self::Draft => 'Draft',
            self::Archived => 'Archived',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Active => 'bg-success/10 text-success',
            self::Draft => 'bg-gray-100 text-gray-600',
            self::Archived => 'bg-gray-100 text-gray-400',
        };
    }
}

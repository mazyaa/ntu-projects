<?php

namespace App\Enums;

enum ArticleStatus: string
{
    case Draft = 'draft';
    case Scheduled = 'scheduled';
    case Published = 'published';
    case Archived = 'archived';

    /**
     * Human-readable Indonesian label.
     */
    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Scheduled => 'Scheduled',
            self::Published => 'Published',
            self::Archived => 'Archived',
        };
    }

    /**
     * Tailwind badge color classes per status.
     */
    public function color(): string
    {
        return match ($this) {
            self::Draft => 'bg-gray-100 text-gray-600',
            self::Scheduled => 'bg-accent/10 text-accent',
            self::Published => 'bg-success/10 text-success',
            self::Archived => 'bg-gray-100 text-gray-400',
        };
    }
}

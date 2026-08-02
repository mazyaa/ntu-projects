<?php

namespace App\Enums;

enum ContactStatus: string
{
    case Unread = 'unread';
    case Read = 'read';
    case Replied = 'replied';
    case Archived = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::Unread => 'Unread',
            self::Read => 'Read',
            self::Replied => 'Replied',
            self::Archived => 'Archived',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Unread => 'bg-danger/10 text-danger',
            self::Read => 'bg-gray-100 text-gray-600',
            self::Replied => 'bg-success/10 text-success',
            self::Archived => 'bg-gray-100 text-gray-400',
        };
    }
}

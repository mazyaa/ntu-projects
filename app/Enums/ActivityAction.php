<?php

namespace App\Enums;

enum ActivityAction: string
{
    case Login = 'login';
    case Logout = 'logout';
    case Created = 'created';
    case Updated = 'updated';
    case Deleted = 'deleted';
    case Published = 'published';
    case Archived = 'archived';
    case Restored = 'restored';
    case Uploaded = 'uploaded';
    case SettingsChanged = 'settings_changed';
    case PasswordChanged = 'password_changed';
    case ProfileUpdated = 'profile_updated';

    public function label(): string
    {
        return match ($this) {
            self::Login => 'Login',
            self::Logout => 'Logout',
            self::Created => 'Created',
            self::Updated => 'Updated',
            self::Deleted => 'Deleted',
            self::Published => 'Published',
            self::Archived => 'Archived',
            self::Restored => 'Restored',
            self::Uploaded => 'Uploaded',
            self::SettingsChanged => 'Settings Changed',
            self::PasswordChanged => 'Password Changed',
            self::ProfileUpdated => 'Profile Updated',
        };
    }
}

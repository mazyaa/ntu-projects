<?php

namespace App\Services;

use App\Enums\ActivityAction;
use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLogService
{
    /**
     * Record an activity log entry.
     */
    public function log(
        ActivityAction|string $action,
        string $description = '',
        ?Model $subject = null,
        array $properties = [],
        ?string $userId = null,
    ): ActivityLog {
        $user = Auth::user();
        $userAgent = Request::userAgent() ?: '';

        return ActivityLog::create([
            'user_id' => $userId ?? $user?->getKey(),
            'action' => $action instanceof ActivityAction ? $action->value : $action,
            'description' => $description,
            'subject_type' => $subject?->getMorphClass(),
            'subject_id' => $subject?->getKey(),
            'ip_address' => Request::ip(),
            'user_agent' => $userAgent,
            'browser' => $this->browser($userAgent),
            'platform' => $this->platform($userAgent),
            'properties' => $properties,
        ]);
    }

    /**
     * Best-effort browser detection from the User-Agent string.
     */
    private function browser(string $userAgent): string
    {
        $map = [
            'Edg/' => 'Edge',
            'OPR/' => 'Opera',
            'Chrome/' => 'Chrome',
            'Firefox/' => 'Firefox',
            'Safari/' => 'Safari',
            'MSIE' => 'Internet Explorer',
        ];

        foreach ($map as $needle => $name) {
            if (str_contains($userAgent, $needle)) {
                return $name;
            }
        }

        return 'Unknown';
    }

    /**
     * Best-effort platform detection from the User-Agent string.
     */
    private function platform(string $userAgent): string
    {
        if (preg_match('/windows nt/i', $userAgent)) {
            return 'Windows';
        }
        if (preg_match('/android/i', $userAgent)) {
            return 'Android';
        }
        if (preg_match('/iphone|ipad|ipod/i', $userAgent)) {
            return 'iOS';
        }
        if (preg_match('/mac os x/i', $userAgent)) {
            return 'macOS';
        }
        if (preg_match('/linux/i', $userAgent)) {
            return 'Linux';
        }

        return 'Unknown';
    }
}

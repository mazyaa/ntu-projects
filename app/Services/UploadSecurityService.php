<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class UploadSecurityService
{
    /**
     * Allowed image MIME types and their extensions.
     */
    private const IMAGE_MIMES = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
        'image/gif' => 'gif',
        'image/svg+xml' => 'svg',
        'image/avif' => 'avif',
    ];

    /**
     * Allowed document MIME types and their extensions.
     */
    private const DOCUMENT_MIMES = [
        'application/pdf' => 'pdf',
        'application/msword' => 'doc',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
        'application/vnd.ms-excel' => 'xls',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
        'application/vnd.ms-powerpoint' => 'ppt',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
        'text/plain' => 'txt',
        'text/csv' => 'csv',
    ];

    /**
     * Allowed audio/video MIME types.
     */
    private const AV_MIMES = [
        'video/mp4' => 'mp4',
        'video/webm' => 'webm',
        'audio/mpeg' => 'mp3',
        'audio/wav' => 'wav',
        'audio/ogg' => 'ogg',
    ];

    /**
     * Whitelist of allowed MIME types => extension.
     */
    public function allowedMimes(): array
    {
        return array_merge(self::IMAGE_MIMES, self::DOCUMENT_MIMES, self::AV_MIMES);
    }

    /**
     * Validate that an uploaded file passes MIME + extension checks.
     */
    public function validate(UploadedFile $file, array $allowed = []): bool
    {
        $mimes = $allowed ?: array_keys($this->allowedMimes());

        return in_array($file->getMimeType(), $mimes, true)
            && in_array(strtolower($file->getClientOriginalExtension()), array_values($this->allowedMimes()), true);
    }

    /**
     * Determine the media type category for a given MIME.
     */
    public function categorize(string $mime): string
    {
        return match (true) {
            isset(self::IMAGE_MIMES[$mime]) => 'image',
            isset(self::DOCUMENT_MIMES[$mime]) => 'document',
            isset(self::AV_MIMES[$mime]) => 'media',
            default => 'other',
        };
    }

    /**
     * Generate a secure UUID-based filename preserving the extension.
     */
    public function secureFilename(UploadedFile $file): string
    {
        $mime = $file->getMimeType();
        $extension = self::IMAGE_MIMES[$mime]
            ?? self::DOCUMENT_MIMES[$mime]
            ?? self::AV_MIMES[$mime]
            ?? $file->getClientOriginalExtension();

        return Str::uuid().'.'.strtolower($extension);
    }
}

<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\ImageManager;

/**
 * Downscale & re-encode images to keep the public site fast.
 *
 * Decode cost (the source of scroll jank) scales with pixel count, not file
 * size, so we cap dimensions rather than just file size. WebP re-encoding
 * additionally shrinks transfer size.
 */
class ImageOptimizerService
{
    public const MAX_WIDTH = 1600;

    public const QUALITY = 78;

    private ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(GdDriver::class);
    }

    /**
     * Downscale an existing image in place, keeping its format and filename.
     * Returns the new size in bytes, or null when nothing was written.
     */
    public function optimize(string $absolutePath, ?int $maxWidth = self::MAX_WIDTH, ?int $maxHeight = null, int $quality = self::QUALITY): ?int
    {
        if (! $this->isSupportedRaster($absolutePath)) {
            return null;
        }

        try {
            $image = $this->manager->decodePath($absolutePath);
        } catch (\Throwable) {
            return null;
        }

        if ($image->isAnimated() || $this->fitsWithin($image, $maxWidth, $maxHeight)) {
            return null;
        }

        $image->scaleDown($maxWidth, $maxHeight);

        // Quality is a lossy-format option; PNG is stored lossless.
        $options = $this->isLossless($absolutePath) ? [] : ['quality' => $quality];

        $image->save($absolutePath, ...$options);

        return filesize($absolutePath);
    }

    /**
     * Optimize an uploaded image and convert it to WebP (the file is brand new,
     * so changing the extension cannot break existing references).
     * Returns [newAbsolutePath, size, mime], or null when skipped.
     */
    public function optimizeToWebp(string $absolutePath, int $maxWidth = self::MAX_WIDTH, int $quality = self::QUALITY): ?array
    {
        if (! $this->isSupportedRaster($absolutePath)) {
            return null;
        }

        try {
            $image = $this->manager->decodePath($absolutePath);
        } catch (\Throwable) {
            return null;
        }

        if ($image->isAnimated()) {
            return null;
        }

        if ($image->width() > $maxWidth) {
            $image->scaleDown($maxWidth, null);
        }

        $webpPath = preg_replace('/\.[a-z0-9]+$/i', '.webp', $absolutePath);

        $image->save($webpPath, quality: $quality);

        @unlink($absolutePath);

        return [
            'path' => $webpPath,
            'size' => filesize($webpPath),
            'mime' => 'image/webp',
        ];
    }

    /**
     * Optimize a stored file (relative to a filesystem disk) and convert it to
     * WebP. Returns storage-relative [path, size, mime], or null when skipped.
     */
    public function optimizeStored(string $disk, string $relativePath): ?array
    {
        $absolute = Storage::disk($disk)->path($relativePath);

        if (! is_file($absolute)) {
            return null;
        }

        $result = $this->optimizeToWebp($absolute);

        if ($result === null) {
            return null;
        }

        $dir = str_replace('\\', '/', dirname($relativePath));

        return [
            'path' => ($dir === '.' ? '' : $dir.'/').basename($result['path']),
            'size' => $result['size'],
            'mime' => $result['mime'],
        ];
    }

    private function isSupportedRaster(string $path): bool
    {
        return in_array(strtolower(pathinfo($path, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp'], true);
    }

    private function isLossless(string $path): bool
    {
        return strtolower(pathinfo($path, PATHINFO_EXTENSION)) === 'png';
    }

    private function fitsWithin($image, ?int $maxWidth, ?int $maxHeight): bool
    {
        return $image->width() <= $maxWidth
            && ($maxHeight === null || $image->height() <= $maxHeight);
    }
}

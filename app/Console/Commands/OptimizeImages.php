<?php

namespace App\Console\Commands;

use App\Services\ImageOptimizerService;
use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;

class OptimizeImages extends Command
{
    protected $signature = 'images:optimize
        {--path= : Optimize a specific file or directory instead of the defaults}
        {--dry-run : Report what would change without writing files}';

    protected $description = 'Downscale & re-encode oversized images (home sections + media library).';

    /**
     * [path suffix => [maxWidth, maxHeight, quality]]
     * Max dimensions match the display size at 2x pixel density.
     */
    private const TARGETS = [
        'public/images/services-images' => [800, 450, 78],
        'public/images/hero-image.webp' => [1920, 1080, 78],
        'public/images/general/about-image.webp' => [1200, 1500, 78],
    ];

    private const GENERIC_DIRS = [
        'storage/app/public/media',
        'storage/app/public/articles',
    ];

    public function handle(ImageOptimizerService $optimizer): int
    {
        $dryRun = (bool) $this->option('dry-run');

        if ($path = $this->option('path')) {
            $jobs = $this->jobsFromPath($path);
        } else {
            $jobs = $this->defaultJobs();
        }

        if ($jobs === []) {
            $this->info('Tidak ada gambar yang perlu diproses.');

            return self::SUCCESS;
        }

        $changed = 0;
        $skipped = 0;

        foreach ($jobs as $job) {
            [$file, $maxWidth, $maxHeight, $quality] = $job;

            $before = file_exists($file) ? filesize($file) : null;
            $label = $this->relative($file);

            if ($dryRun) {
                $result = $this->projected($optimizer, $file, $maxWidth, $maxHeight, $quality);

                if ($result === null) {
                    $skipped++;

                    $this->line("  <fg=gray>[SKIP] {$label}</>");

                    continue;
                }

                $changed++;

                $this->line("  <fg=yellow>[DRY-RUN] {$label}: ".$this->human($before).' -> '.$this->human($result).'</>');

                continue;
            }

            $result = $optimizer->optimize($file, $maxWidth, $maxHeight, $quality);
            $after = file_exists($file) ? filesize($file) : null;

            if ($result === null) {
                $skipped++;

                $this->line("  <fg=gray>[SKIP] {$label}</>");

                continue;
            }

            $changed++;

            $this->line("  <info>[OK]</info> {$label}: ".$this->human($before).' -> '.$this->human($after));
        }

        if ($dryRun) {
            $this->newLine();
            $this->info("{$changed} file akan dioptimasi, {$skipped} dilewati.");

            return self::SUCCESS;
        }

        $this->newLine();
        $this->info("Selesai: {$changed} file dioptimasi, {$skipped} dilewati.");

        return self::SUCCESS;
    }

    /**
     * @return array<int, array{0: string, 1: ?int, 2: ?int, 3: int}>
     */
    private function defaultJobs(): array
    {
        $jobs = [];

        foreach (self::TARGETS as $target => [$maxWidth, $maxHeight, $quality]) {
            $absolute = base_path($target);

            if (is_file($absolute)) {
                $jobs[] = [$absolute, $maxWidth, $maxHeight, $quality];

                continue;
            }

            foreach ($this->imageFiles($absolute) as $file) {
                $jobs[] = [$file, $maxWidth, $maxHeight, $quality];
            }
        }

        foreach (self::GENERIC_DIRS as $dir) {
            foreach ($this->imageFiles(base_path($dir)) as $file) {
                $jobs[] = [$file, ImageOptimizerService::MAX_WIDTH, null, ImageOptimizerService::QUALITY];
            }
        }

        return $jobs;
    }

    /**
     * @return array<int, array{0: string, 1: ?int, 2: ?int, 3: int}>
     */
    private function jobsFromPath(string $path): array
    {
        $absolute = $this->absolutePath($path);

        if (is_file($absolute)) {
            return [[$absolute, ImageOptimizerService::MAX_WIDTH, null, ImageOptimizerService::QUALITY]];
        }

        if (is_dir($absolute)) {
            return array_map(
                fn (string $file) => [$file, ImageOptimizerService::MAX_WIDTH, null, ImageOptimizerService::QUALITY],
                $this->imageFiles($absolute),
            );
        }

        $this->error("Path tidak ditemukan: {$path}");

        return [];
    }

    /**
     * @return array<int, string>
     */
    private function imageFiles(string $directory): array
    {
        if (! is_dir($directory)) {
            return [];
        }

        $files = Finder::create()
            ->files()
            ->in($directory)
            ->name('/\.(jpe?g|png|webp)$/i')
            ->sortByName();

        return array_map(fn ($file) => $file->getRealPath(), iterator_to_array($files));
    }

    private function absolutePath(string $path): string
    {
        return str_starts_with($path, DIRECTORY_SEPARATOR)
            || preg_match('/^[A-Za-z]:[\\\\\\/]/', $path)
            ? $path
            : base_path($path);
    }

    private function relative(string $file): string
    {
        return str_replace(base_path(DIRECTORY_SEPARATOR), '', $file);
    }

    /**
     * Measure the size an optimize() run would produce, without touching $file.
     */
    private function projected(ImageOptimizerService $optimizer, string $file, ?int $maxWidth, ?int $maxHeight, int $quality): ?int
    {
        $tmp = tempnam(sys_get_temp_dir(), 'imgopt');

        if ($tmp === false) {
            return null;
        }

        copy($file, $tmp);

        try {
            $result = $optimizer->optimize($tmp, $maxWidth, $maxHeight, $quality);

            return $result === null ? null : filesize($tmp);
        } finally {
            @unlink($tmp);
        }
    }

    private function human(?int $bytes): string
    {
        if ($bytes === null) {
            return '?';
        }

        return round($bytes / 1024, 1).' KB';
    }
}

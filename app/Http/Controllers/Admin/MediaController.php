<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Services\ImageOptimizerService;
use App\Services\UploadSecurityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function __construct(
        private readonly UploadSecurityService $uploadSecurity,
        private readonly ImageOptimizerService $imageOptimizer,
    ) {}

    public function store(Request $request)
    {
        $request->validate([
            'files' => ['required', 'array', 'max:10'],
            'files.*' => ['file', 'max:10240'],
        ]);

        $uploaded = 0;
        $errors = [];

        foreach ($request->file('files') as $file) {
            if (! $this->uploadSecurity->validate($file)) {
                $errors[] = "File {$file->getClientOriginalName()} ditolak: tipe tidak diizinkan.";

                continue;
            }

            $path = $file->store('media', 'public');

            $optimized = $this->imageOptimizer->optimizeStored('public', $path);
            $storedPath = $optimized['path'] ?? $path;

            Media::create([
                'uploaded_by' => auth()->id(),
                'name' => basename($storedPath),
                'original_name' => $file->getClientOriginalName(),
                'path' => $storedPath,
                'mime_type' => $optimized['mime'] ?? $file->getMimeType(),
                'size' => $optimized['size'] ?? $file->getSize(),
                'type' => $this->uploadSecurity->categorize($optimized['mime'] ?? $file->getMimeType()),
                'disk' => 'public',
            ]);

            $uploaded++;
        }

        $message = "Berhasil mengunggah {$uploaded} berkas.";
        if ($errors) {
            $message .= ' '.implode(' ', $errors);

            return back()->with('error', $message);
        }

        return back()->with('success', $message);
    }

    public function destroy(Media $media)
    {
        Storage::disk($media->disk)->delete($media->path);

        $media->delete();

        return back()->with('success', 'Berkas media berhasil dihapus.');
    }
}

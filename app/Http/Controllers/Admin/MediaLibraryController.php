<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Services\ImageOptimizerService;
use App\Services\UploadSecurityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MediaLibraryController extends Controller
{
    public function __construct(
        private UploadSecurityService $uploadSecurity,
        private ImageOptimizerService $imageOptimizer,
    ) {}

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'file' => ['required', 'file', 'max:10240'],
        ]);

        $file = $request->file('file');

        if (! $this->uploadSecurity->validate($file)) {
            if ($request->ajax()) {
                return response()->json(['message' => 'File type not allowed.'], 422);
            }

            return back()->withErrors(['file' => 'File type not allowed.']);
        }

        $path = $file->store('media', 'public');
        $optimized = $this->imageOptimizer->optimizeStored('public', $path);

        $name = $optimized ? basename($optimized['path']) : $file->getClientOriginalName();
        $path = $optimized ? $optimized['path'] : $path;
        $mimeType = $optimized ? $optimized['mime'] : $file->getMimeType();
        $size = $optimized ? $optimized['size'] : $file->getSize();

        $media = Media::create([
            'uploaded_by' => auth()->id(),
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $mimeType,
            'size' => $size,
            'type' => app(UploadSecurityService::class)->categorize($mimeType),
            'disk' => 'public',
        ]);

        if ($request->ajax()) {
            return response()->json([
                'url' => $media->url(),
                'path' => $media->path,
                'id' => $media->getKey(),
            ]);
        }

        return back()->with('success', 'File berhasil diunggah.');
    }

    public function destroy(Media $media)
    {
        $path = $media->path;

        if ($path && \Storage::disk('media')->exists($path)) {
            \Storage::disk('media')->delete($path);
        }

        $media->delete();

        return back()->with('success', 'Media berhasil dihapus.');
    }
}

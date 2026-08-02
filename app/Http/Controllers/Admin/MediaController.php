<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Services\UploadSecurityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function __construct(
        private readonly UploadSecurityService $uploadSecurity,
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

            Media::create([
                'uploaded_by' => auth()->id(),
                'name' => $this->uploadSecurity->secureFilename($file),
                'original_name' => $file->getClientOriginalName(),
                'path' => $path,
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'type' => $this->uploadSecurity->categorize($file->getMimeType()),
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

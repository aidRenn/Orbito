<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Http\UploadedFile;
use App\Services\CloudinaryService;


class ProjectPhoto extends Model
{
    protected $fillable = [
        'project_id',
        'photo',
        'caption',
        'order',
    ];

public function setPhotoAttribute($value)
{
    if (! $value) {
        $this->attributes['photo'] = null;
        return;
    }

    // CASE — object upload
    if ($value instanceof TemporaryUploadedFile || $value instanceof UploadedFile) {

        $result = CloudinaryService::uploadImage($value, 'showcase/projects/photos');

        $this->attributes['photo'] = $result['url'] ?? null;

        try { $value->delete(); } catch (\Throwable $e) {}

        return;
    }

    // CASE — temp path string
    if (is_string($value) && str_starts_with($value, 'temp/')) {

        $path = Storage::disk('public')->path($value);

        if (file_exists($path)) {

            $file = new UploadedFile(
                $path,
                basename($path),
                mime_content_type($path),
                test: true
            );

            $result = CloudinaryService::uploadImage($file, 'showcase/projects/photos');

            Storage::disk('public')->delete($value);

            $this->attributes['photo'] = $result['url'] ?? null;

            return;
        }
    }

    $this->attributes['photo'] = $value;
}


public function project()
{
    return $this->belongsTo(\App\Models\Project::class);
}

}

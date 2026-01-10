<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Http\UploadedFile;
use App\Services\CloudinaryService;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'category_id',
        'overview',
        'features',
        'status',
        'is_featured',
        'client_name',
        'project_url',
        'github_url',
        'started_at',
        'finished_at',
    ];

    protected $casts = [
        'started_at' => 'date',
        'finished_at' => 'date',
        'features' => 'array', // support JSON or array list
    ];

    
    /* =======================
       CLOUDINARY THUMBNAIL
    ======================== */
    public function setThumbnailAttribute($value): void
    {
        // allow clearing thumbnail
        if (! $value) {
            $this->attributes['thumbnail'] = null;
            return;
        }

        // CASE 1 — Livewire / Filament upload object
        if ($value instanceof TemporaryUploadedFile || $value instanceof UploadedFile) {

            // optional: delete old thumbnail
            if (! empty($this->attributes['thumbnail'])) {
                // tidak delete lama kalau kamu memang ingin disimpan
                // kalau mau auto delete → bilang ya nanti kita aktifkan
            }

            $result = CloudinaryService::uploadImage($value, 'showcase/projects/thumbnails');

            $this->attributes['thumbnail'] = $result['url'] ?? null;

            try { $value->delete(); } catch (\Throwable $e) {}

            return;
        }

        // CASE 2 — Filament sends temp path string
        if (is_string($value) && str_starts_with($value, 'temp/')) {

            $path = Storage::disk('public')->path($value);

            if (file_exists($path)) {

                $file = new UploadedFile(
                    $path,
                    basename($path),
                    mime_content_type($path),
                    test: true
                );

                $result = CloudinaryService::uploadImage($file, 'showcase/projects/thumbnails');

                Storage::disk('public')->delete($value);

                $this->attributes['thumbnail'] = $result['url'] ?? null;

                return;
            }
        }

        // fallback — assume already URL
        $this->attributes['thumbnail'] = $value;
    }


    /* =======================
       ACCESSOR (DIRECT URL)
    ======================== */
    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail ?: null;
    }


    /* =======================
       DELETE RELATED FILES
    ======================== */
    protected static function booted()
    {
        static::deleting(function ($project) {

            // opsional: hapus thumbnail Cloudinary lama?
            // saat ini: tidak dihapus (sesuai keputusan "tanpa public_id")

            // delete gallery photos → akan pakai mutator masing2
            $project->photos()->each->delete();
        });
    }

    // Category relation
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Tech stacks (pivot)
    public function stacks()
    {
        return $this->belongsToMany(Stack::class, 'project_stack');
    }

    // Gallery photos
public function photos()
{
    return $this->hasMany(\App\Models\ProjectPhoto::class)->orderBy('order');
}

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Http\UploadedFile;
use App\Services\CloudinaryService;



class Stack extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
    ];

    protected static function booted()
    {
        static::saving(function ($stack) {

            // --- AUTO SLUG ---
            if (! $stack->slug && $stack->name) {

                $base = Str::slug($stack->name);
                $slug = $base;
                $i = 1;

                while (
                    self::where('slug', $slug)
                        ->where('id', '!=', $stack->id)
                        ->exists()
                ) {
                    $slug = "{$base}-{$i}";
                    $i++;
                }

                $stack->slug = $slug;
            }
        });
    }


public function setIconAttribute($value): void
{
    if (! $value) {
        $this->attributes['icon'] = null;
        return;
    }

    // CASE 1 — object upload (Livewire / Filament)
    if ($value instanceof TemporaryUploadedFile || $value instanceof UploadedFile) {

        $result = CloudinaryService::uploadImage($value, 'showcase/stacks');

        $this->attributes['icon'] = $result['url'] ?? null;

        try { $value->delete(); } catch (\Throwable $e) {}

        return;
    }

    // CASE 2 — Filament gives temp path string
    if (is_string($value) && str_starts_with($value, 'temp/')) {

        $path = Storage::disk('public')->path($value);

        if (file_exists($path)) {

            $file = new UploadedFile(
                $path,
                basename($path),
                mime_content_type($path),
                test: true
            );

            $result = CloudinaryService::uploadImage($file, 'showcase/stacks');

            Storage::disk('public')->delete($value);

            $this->attributes['icon'] = $result['url'] ?? null;

            return;
        }
    }

    // fallback — assume URL
    $this->attributes['icon'] = $value;
}
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_stack');
    }
}

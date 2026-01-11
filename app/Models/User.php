<?php

namespace App\Models;

use App\Models\Project;
use App\Services\CloudinaryService;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * User owns many projects
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Allow access to Filament panel
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return true; // bisa kamu ganti pakai role/admin nanti
    }

    /**
     * Avatar mutator (Cloudinary)
     */
    public function setAvatarAttribute($value): void
    {
        // Edit tanpa upload → jangan sentuh avatar lama
        if ($value === null) {
            return;
        }

        if ($value instanceof TemporaryUploadedFile || $value instanceof UploadedFile) {

            $result = CloudinaryService::uploadImage($value, 'showcase/users/avatars');

            $this->attributes['avatar'] = $result['url'] ?? null;

            try {
                $value->delete();
            } catch (\Throwable $e) {}

            return;
        }

        if (is_string($value) && str_starts_with($value, 'temp/')) {

            $path = Storage::disk('public')->path($value);

            if (file_exists($path)) {
                $file = new UploadedFile(
                    $path,
                    basename($path),
                    mime_content_type($path),
                    test: true
                );

                $result = CloudinaryService::uploadImage($file, 'showcase/users/avatars');

                Storage::disk('public')->delete($value);

                $this->attributes['avatar'] = $result['url'] ?? null;
                return;
            }
        }

        $this->attributes['avatar'] = $value;
    }
}

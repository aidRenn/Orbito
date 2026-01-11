<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Project;
use Illuminate\Http\UploadedFile;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Services\CloudinaryService;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
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

    public function setAvatarAttribute($value): void
{
    // Edit tanpa upload → jangan sentuh avatar lama
    if ($value === null) {
        return;
    }

    if ($value instanceof TemporaryUploadedFile || $value instanceof UploadedFile) {

        $result = CloudinaryService::uploadImage($value, 'showcase/users/avatars');

        $this->attributes['avatar'] = $result['url'] ?? null;

        try { $value->delete(); } catch (\Throwable $e) {}

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

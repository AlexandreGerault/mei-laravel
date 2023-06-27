<?php

namespace Admin\Infrastructure\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Storage;

class Admin extends User implements FilamentUser, HasName, HasAvatar
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function canAccessFilament(): bool
    {
        return true;
    }

    public function getFilamentName(): string
    {
        return $this->username;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        if ($this->avatar === null) {
            return null;
        }

        return Storage::disk('s3')->temporaryUrl(
            $this->avatar,
            now()->addMinutes(5),
        );
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
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
        'role',
        'google_id',
        'google_avatar',
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
     * Get the attributes that should be cast.
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
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is petinggi
     */
    public function isPetinggi(): bool
    {
        return $this->role === 'petinggi';
    }

    /**
     * Check if user is calon_member
     */
    public function isCalon(): bool
    {
        return $this->role === 'calon_member';
    }

    /**
     * Check if user can access Filament
     */
    public function canAccessFilament(): bool
    {
        return $this->isAdmin() || $this->isPetinggi();
    }

    /**
     * Check if user is read-only (petinggi)
     */
    public function isReadOnly(): bool
    {
        return $this->isPetinggi();
    }
}

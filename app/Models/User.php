<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
class User extends Authenticatable implements MustVerifyEmail, FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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


    // mail verification
    public function canAccessPanel(Panel $panel): bool
    {
        // return true;
        if (auth()->user()->hasRole('super_admin')) {
            return true;
        }elseif (auth()->user()->hasRole('agen') || auth()->user()->hasRole('user')) {
            return true;
        }else
        {
            return str_ends_with($this->email, '@gmail.com') && $this->hasVerifiedEmail();
        }
    }

    public function profiles()
    {
        return $this->hasOne(Profile::class, 'users_id') ?? null;
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'users_id') ?? null;
    }
}

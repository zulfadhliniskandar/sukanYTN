<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'email', 'password', 'role', 'contingent_id'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles {
        HasRoles::hasRole as spatieHasRole;
    }

    /**
     * Override hasRole to check the 'role' database column first,
     * with fallback to Spatie's role management tables.
     */
    public function hasRole($roles, $guard = null): bool
    {
        if (is_string($roles) && strtolower((string) $this->role) === strtolower($roles)) {
            return true;
        }

        if (is_array($roles)) {
            foreach ($roles as $r) {
                if (is_string($r) && strtolower((string) $this->role) === strtolower($r)) {
                    return true;
                }
            }
        }

        return $this->spatieHasRole($roles, $guard);
    }

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

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable, HasApiTokens;

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

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    public function isAdmin(): bool
    {
        $roles = $this->roles;
        return $roles->contains('role_type_id', 1);
    }

    public function isMarketSupervisor(): bool
    {
        $roles = $this->roles;
        return $roles->contains('role_type_id', 2);
    }

    public function isAdminAide(): bool
    {
        $roles = $this->roles;
        return $roles->contains('role_type_id', 4);
    }

    public function isMarketSpecialist(): bool
    {
        $roles = $this->roles;
        return $roles->contains('role_type_id', 5);
    }

    public function isMarketInspector(): bool
    {
        $roles = $this->roles;
        return $roles->contains('role_type_id', 3);
    }

    public function marketDesignation()
    {
        $roles = $this->roles;
        return $roles->first()->municipalMarket;
    }

    public function isVendor(): bool
    {
        $roles = $this->roles;
        return $roles->contains('role_type_id', 6);
    }

    public function isMarketAdmin() {
        $roles = $this->roles;
        return $roles->contains('role_type_id', 7); 
    }

    public function vendor()
    {
        return $this->hasOne(Vendor::class);
    }

    public function appSettings()
    {
        return AppSettings::where('municipal_market_id', $this->marketDesignation()->id)->first();
    }

    public function getAccessAttribute()
    {
        return RolePreset::where('municipal_market_id', $this->marketDesignation()->id)->where('role_type_id', $this->roles->first()->role_type_id)->first();
    }
}

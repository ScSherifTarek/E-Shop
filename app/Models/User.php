<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const TYPE_MERCHANT = 'merchant';
    public const TYPE_CONSUMER = 'consumer';
    public const TYPES = [self::TYPE_MERCHANT, self::TYPE_CONSUMER];

    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'store_name'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function isOfType(string $type): bool
    {
        return $this->type === $type;
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'owner_id');
    }
    
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'user_id');
    }

    public function getCart(): Cart
    {
        return $this->carts()->where('status', Cart::STATUS_BEING_FILLED)->firstOrCreate();
    }
}

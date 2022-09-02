<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'verification_code',
        'email_verified_at',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // One-Many relationship with comment
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    // Filter user
    public function scopeFilter($query, $filter) {
        return $query->Where('verification_code', '!=', '$2y$10$n8rIoiDkfHfLsB2teVg2OubuETJ9phPK4.69lGJPmzKvONErg1m8m')
                    ->Where('name', 'LIKE', '%' . $filter . '%')
                    ->orWhere('email', 'LIKE', '%' . $filter . '%');
    }
}

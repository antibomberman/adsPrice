<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    protected $fillable = [
        'name',
        'avatar',
        'password',
        'balance',
        'category_id',
        'role_id',
        'status_id',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    function category(): BelongsTo
    {
        return  $this->belongsTo(Category::class);
    }
    function status(): BelongsTo
    {
        return  $this->belongsTo(Status::class);
    }
    function role(): BelongsTo
    {
        return  $this->belongsTo(Role::class);
    }
    function orders(): HasMany
    {
        return  $this->hasMany(Order::class);
    }

    function bloggerOrders(): HasMany
    {
        return  $this->hasMany(BloggerOrder::class);
    }
    function bloggerPlatforms(): HasMany
    {
        return  $this->hasMany(BloggerPlatform::class);
    }



}

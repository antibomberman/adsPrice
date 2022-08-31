<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BloggerPlatform extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['platform_id','user_id','status_id','link'];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    function platform(): BelongsTo
    {
        return  $this->belongsTo(Platform::class);
    }
    function user(): BelongsTo
    {
        return  $this->belongsTo(User::class);
    }
    function status(): BelongsTo
    {
        return  $this->belongsTo(Status::class);
    }
}

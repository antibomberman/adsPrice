<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Collection;

class BloggerOrder extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['user_id','order_id','token'];
    protected $hidden = ['updated_at','deleted_at'];

    function order(): BelongsTo
    {
        return  $this->belongsTo(Order::class);
    }
    function user(): BelongsTo
    {
        return  $this->belongsTo(User::class);
    }
}

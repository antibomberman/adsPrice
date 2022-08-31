<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['user_id','status_id','category_id','count','price','link'];
    protected $hidden = ['updated_at','deleted_at'];

    function user():BelongsTo
    {
        return  $this->belongsTo(User::class);
    }
    function status():BelongsTo
    {
        return  $this->belongsTo(Status::class);
    }
    function category():BelongsTo
    {
        return  $this->belongsTo(Category::class);
    }
    function bloggerOrders(): HasMany
    {
        return  $this->hasMany(BloggerOrder::class);
    }
}

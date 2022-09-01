<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Collection;

/**
 * App\Models\BloggerOrder
 *
 * @property int $id
 * @property int $user_id блогер
 * @property int $order_id
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrder newQuery()
 * @method static \Illuminate\Database\Query\Builder|BloggerOrder onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrder whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrder whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrder whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrder whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|BloggerOrder withTrashed()
 * @method static \Illuminate\Database\Query\Builder|BloggerOrder withoutTrashed()
 * @mixin \Eloquent
 */
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

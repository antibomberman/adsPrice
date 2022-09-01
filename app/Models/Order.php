<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $user_id заказчик
 * @property int $status_id
 * @property int $category_id
 * @property int $count Сколько view нужно
 * @property float $price цена за 1 view
 * @property string $link ссылка от заказчика
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BloggerOrder[] $bloggerOrders
 * @property-read int|null $blogger_orders_count
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Status $status
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Query\Builder|Order onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Order withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Order withoutTrashed()
 * @mixin \Eloquent
 */
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

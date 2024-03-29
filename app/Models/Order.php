<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $user_id заказчик
 * @property int $category_id
 * @property int $count Сколько view нужно
 * @property float $price цена за 1 view
 * @property string $link ссылка от заказчика
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BloggerOrder[] $bloggerOrders
 * @property-read int|null $blogger_orders_count
 * @property-read \App\Models\Category $category
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
 * @property string|null $video video path
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereVideo($value)
 * @property int $status
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeletedAt($value)
 * @property string|null $name
 * @property int|null $video_view_count
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereVideoViewCount($value)
 * @property string|null $video_link
 * @property string|null $name_ru
 * @property string|null $name_kz
 * @property string|null $description_ru
 * @property string|null $description_kz
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDescriptionKz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereNameKz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereNameRu($value)
 */
class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'status',
        'category_id',
        'count',
        'price',
        'name_kz',
        'name_ru',
        'link',
        'video',
        'video_link',
        'description_kz',
        'description_ru',
        'video_view_count'
    ];

    protected $hidden = ['updated_at', 'deleted_at'];

    public function user(): BelongsTo
    {
        return  $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return  $this->belongsTo(Category::class);
    }

    public function bloggerOrders(): HasMany
    {
        return  $this->hasMany(BloggerOrder::class);
    }

    protected function video(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset(Storage::disk('public')->url($value)) : '',
            set: fn ($value) => Storage::disk('public')->putFile('videos/'.Carbon::now()->format('Y/m'), $value),
        );
    }

    public function getViewCount(): int
    {
        return BloggerOrder::join('blogger_order_views', 'blogger_order_views.blogger_order_id', 'blogger_orders.id')
            ->where('order_id', $this->id)
            ->count();
    }
}

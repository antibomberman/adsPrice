<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property int $count
 * @property int $status
 * @property string|null $url
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrder whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrder whereUrl($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BloggerOrderView[] $bloggerOrderView
 * @property-read int|null $blogger_order_view_count
 * @property int $video_view_count video_view_count
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrder whereVideoViewCount($value)
 * @property int $video_like_count
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrder whereVideoLikeCount($value)
 */
class BloggerOrder extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['user_id', 'order_id', 'token', 'url','count','video_view_count','video_like_count','status'];

    protected $hidden = ['updated_at', 'deleted_at'];

    public function order(): BelongsTo
    {
        return  $this->belongsTo(Order::class);
    }

    public function user(): BelongsTo
    {
        return  $this->belongsTo(User::class);
    }

    public function bloggerOrderView(): HasMany
    {
        return  $this->hasMany(BloggerOrderView::class);
    }

    protected function token(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => route('referral', $value),
        );
    }
}

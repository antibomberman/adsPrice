<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Notification
 *
 * @property int $id
 * @property int $type
 * @property int $is_read
 * @property int|null $from_user_id
 * @property int|null $to_user_id
 * @property int|null $order_id
 * @property int|null $task_id
 * @property string $title
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereOtherUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUserId($value)
 * @mixin \Eloquent
 */
class Notification extends Model
{
    use HasFactory;

    protected $fillable  = ['from_user_id','to_user_id','order_id','task_id','description','type','title','is_read'];

    function fromUser():BelongsTo
    {
        return  $this->belongsTo(User::class,'from_user_id')->withTrashed();
    }
    function toUser():BelongsTo
    {
        return  $this->belongsTo(User::class,'to_user_id')->withTrashed();
    }
    function task():BelongsTo
    {
        return  $this->belongsTo(Task::class)->withTrashed();
    }
    function order():BelongsTo
    {
        return  $this->belongsTo(Order::class)->withTrashed();
    }
}

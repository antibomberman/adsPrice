<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BloggerOrderView
 *
 * @property int $id
 * @property int $blogger_order_id
 * @property string $ip
 * @property string $agent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrderView newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrderView newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrderView query()
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrderView whereAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrderView whereBloggerOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrderView whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrderView whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrderView whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrderView whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property int $open_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerOrderView whereOpenCount($value)
 */
class BloggerOrderView extends Model
{
    use HasFactory;

    protected $fillable = ['blogger_order_id', 'ip', 'agent'];
}

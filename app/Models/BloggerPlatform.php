<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\BloggerPlatform
 *
 * @property int $id
 * @property int $platform_id
 * @property int $user_id
 * @property int $status_id
 * @property string $link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Platform $platform
 * @property-read \App\Models\Status $status
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform newQuery()
 * @method static \Illuminate\Database\Query\Builder|BloggerPlatform onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform query()
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform wherePlatformId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|BloggerPlatform withTrashed()
 * @method static \Illuminate\Database\Query\Builder|BloggerPlatform withoutTrashed()
 * @mixin \Eloquent
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform whereStatus($value)
 *
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform whereDeletedAt($value)
 */
class BloggerPlatform extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['platform_id', 'user_id', 'status', 'link'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function platform(): BelongsTo
    {
        return  $this->belongsTo(Platform::class);
    }

    public function user(): BelongsTo
    {
        return  $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\BalanceOperation
 *
 * @property int $id
 * @property int $user_id
 * @property float $value
 * @property float $balance
 * @property string $operation
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceOperation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceOperation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceOperation query()
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceOperation whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceOperation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceOperation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceOperation whereOperation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceOperation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceOperation whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceOperation whereValue($value)
 * @mixin \Eloquent
 */
class BalanceOperation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','value','balance','operation'];

    function user():BelongsTo
    {
        return  $this->belongsTo(User::class);
    }
}

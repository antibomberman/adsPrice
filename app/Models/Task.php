<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Task
 *
 * @property int $id
 * @property int $user_id
 * @property int $status
 * @property string|null $name
 * @property string|null $description
 * @property float|null $price
 * @property string|null $text_1
 * @property string|null $text_2
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereText1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereText2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $name_ru
 * @property string|null $name_kz
 * @property string|null $description_ru
 * @property string|null $description_kz
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|Task onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDescriptionKz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereNameKz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereNameRu($value)
 * @method static \Illuminate\Database\Query\Builder|Task withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Task withoutTrashed()
 */
class Task extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'name_kz',
        'name_ru',
        'description_kz',
        'description_ru',
        'text_1',
        'text_2',
        'status',
        'price'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

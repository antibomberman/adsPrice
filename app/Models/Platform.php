<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Platform
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Platform newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Platform newQuery()
 * @method static \Illuminate\Database\Query\Builder|Platform onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Platform query()
 * @method static \Illuminate\Database\Eloquent\Builder|Platform whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Platform whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Platform whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Platform whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Platform whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Platform whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Platform withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Platform withoutTrashed()
 * @mixin \Eloquent
 */
class Platform extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name','icon'];

    protected $hidden = ['created_at','deleted_at','updated_at'];
}

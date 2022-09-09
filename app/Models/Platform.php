<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Platform
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
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

    protected $fillable = ['name', 'icon'];

    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];

    protected function icon(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset(Storage::disk('public')->url($value)) : '',
            set: fn ($value) => Storage::disk('public')->putFile('images/'.Carbon::now()->format('Y/m'), $value),
        );
    }
}

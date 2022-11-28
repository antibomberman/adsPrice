<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\TaskBloggerImage
 *
 * @property int $id
 * @property int $task_blogger_id
 * @property string $path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TaskBloggerImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskBloggerImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskBloggerImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskBloggerImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskBloggerImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskBloggerImage wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskBloggerImage whereTaskBloggerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskBloggerImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TaskBloggerImage extends Model
{
    use HasFactory;

    protected $fillable = ['task_blogger_id','path'];

    protected function path(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset(Storage::disk('public')->url($value)) : 'https://www.onelove.org/wp-content/uploads/2015/10/missingheadshot.jpg',
            set: fn ($value) => Storage::disk('public')->putFile('images/'.Carbon::now()->format('Y/m'), $value),
        );
    }
}

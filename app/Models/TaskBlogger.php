<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\TaskBlogger
 *
 * @property int $id
 * @property int $status
 * @property int $task_id
 * @property int $blogger_id
 * @property string|null $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $blogger
 * @property-read \App\Models\Task $task
 * @method static \Illuminate\Database\Eloquent\Builder|TaskBlogger newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskBlogger newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskBlogger query()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskBlogger whereBloggerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskBlogger whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskBlogger whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskBlogger whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskBlogger whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskBlogger whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskBlogger whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TaskBlogger extends Model
{
    use HasFactory;

    protected $fillable = ['blogger_id','task_id','status','message','link'];

    public function task():BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
    public function blogger():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function images():HasMany
    {
        return  $this->hasMany(TaskBloggerImage::class);
    }
}

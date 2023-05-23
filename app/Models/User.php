<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $password
 * @property string|null $avatar
 * @property float $balance
 * @property int $category_id
 * @property int $status_id
 * @property int $role_id
 * @property int $manager_id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BloggerOrder[] $bloggerOrders
 * @property-read int|null $blogger_orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BloggerPlatform[] $bloggerPlatforms
 * @property-read int|null $blogger_platforms_count
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \App\Models\Role $role
 * @property-read \App\Models\Status $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\OwenIt\Auditing\Models\Audit[] $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDescription($value)
 * @property string|null $description_ru
 * @property string|null $description_kz
 * @property int|null $is_agree
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDescriptionKz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAgree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereManagerId($value)
 */
class User extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes,\OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name',
        'avatar',
        'phone',
        'password',
        'balance',
        'category_id',
        'role_id',
        'status',
        'description_kz',
        'description_ru',
        'is_agree',
        'manager_id',
        'show_tasks',
        'iban'
    ];

    protected $hidden = [
        'password',
        'deleted_at',
        'updated_at',

        'remember_token',
    ];



    public function isCustomer(): bool
    {
        return $this->role_id == 1;
    }

    public function isBlogger(): bool
    {
        return $this->role_id == 2;
    }
    public function isAdmin(): bool
    {
        return $this->role_id == 3;
    }


    public function isModerator(): bool
    {
        return $this->role_id == 4;
    }
    public function isManager(): bool
    {
        return $this->role_id == 5;
    }
    public function category(): BelongsTo
    {
        return  $this->belongsTo(Category::class);
    }

    public function role(): BelongsTo
    {
        return  $this->belongsTo(Role::class);
    }

    public function orders(): HasMany
    {
        return  $this->hasMany(Order::class);
    }
    public function posts(): HasMany
    {
        return  $this->hasMany(Post::class);
    }

    public function bloggerOrders(): HasMany
    {
        return  $this->hasMany(BloggerOrder::class);
    }

    public function bloggerPlatforms(): HasMany
    {
        return  $this->hasMany(BloggerPlatform::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class,'to_user_id');
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make($value),
        );
    }

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset(Storage::disk('public')->url($value)) : 'https://www.onelove.org/wp-content/uploads/2015/10/missingheadshot.jpg',
            set: fn ($value) => Storage::disk('public')->putFile('images/'.Carbon::now()->format('Y/m'), $value),
        );
    }
}

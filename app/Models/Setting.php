<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string|null $balance_phone телефон номер кассы
 * @property string|null $offer Оферта
 * @property string|null $privacy_policy Политика конфиденциальности
 * @property string|null $user_agreement Пользовательское соглашение
 * @property string|null $help Помощь
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereBalancePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereHelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereOffer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting wherePrivacyPolicy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUserAgreement($value)
 * @mixin \Eloquent
 */
class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['balance_phone', 'user_agreement', 'offer', 'help', 'privacy_policy'];
}

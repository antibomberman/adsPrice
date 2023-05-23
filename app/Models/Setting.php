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
 * @property string|null $about about
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
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
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAbout($value)
 * @property string|null $offer_ru Оферта
 * @property string|null $offer_kz
 * @property string|null $privacy_policy_ru Политика конфиденциальности
 * @property string|null $privacy_policy_kz
 * @property string|null $user_agreement_ru Пользовательское соглашение
 * @property string|null $user_agreement_kz
 * @property string|null $help_ru Помощь
 * @property string|null $help_kz
 * @property string|null $about_ru
 * @property string|null $about_kz
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAboutKz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAboutRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereHelpKz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereHelpRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereOfferKz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereOfferRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting wherePrivacyPolicyKz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting wherePrivacyPolicyRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUserAgreementKz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUserAgreementRu($value)
 */
class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'balance_phone_kz',
        'balance_phone_ru',
        'user_agreement_kz',
        'user_agreement_ru',
        'offer_kz',
        'offer_ri',
        'help_ru',
        'help_kz',
        'privacy_policy_ru',
        'privacy_policy_kz',
        'about_ru',
        'about_kz'
    ];
}

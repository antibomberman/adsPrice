<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SettingUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'balance_phone_kz' => '',
            'balance_phone_ru' => '',

            'offer_kz' => '',
            'privacy_policy_kz' => '',
            'user_agreement_kz' => '',
            'help_kz' => '',
            'about_kz' => '',

            'offer_ru' => 'string',
            'privacy_policy_ru' => 'string',
            'user_agreement_ru' => 'string',
            'help_ru' => 'string',
            'about_ru' => 'string',
        ];
    }

    public function messages()
    {
        return [
        ];
    }

    public function failedValidation($validator)
    {
        throw new HttpResponseException(
            response()->json(['message' => $validator->errors()->first()], 400)
        );
    }
}

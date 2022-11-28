<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class NotificationStoreRequest extends FormRequest
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
            'from_user_id' => ['required','exists:users,id'],
            'to_user_id' => ['exists:users,id'],
            'task_id' => ['exists:tasks,id'],
            'order_id' => ['exists:orders,id'],
            'title_kz' => ['string'],
            'title_ru' => ['string'],
            'description_kz' => ['string'],
            'description_ru' => ['string'],
            'type' => ['numeric'],
        ];
    }

    public function messages()
    {
        return [
            'phone.exists' => 'неверный телефон номер',
        ];
    }

    public function failedValidation( $validator)
    {
        throw new HttpResponseException(
            response()->json(['message' => $validator->errors()->first()],400)
        );
    }
}

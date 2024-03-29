<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderStoreRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'count' => 'integer',
            'name_kz' => 'string',
            'name_ru' => 'string',
            'price' => 'integer',
            'link' => 'required|url',
            'video' => 'file',
            'video_link' => 'string',
            'description_ru' => 'string',
            'description_kz' => 'string',
        ];
    }

    public function messages()
    {
        return [
        ];
    }

    public function failedValidation( $validator)
    {
        throw new HttpResponseException(
            response()->json(['message' => $validator->errors()->first()],400)
        );
    }
}

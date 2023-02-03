<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderUpdateRequest extends FormRequest
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
            'category_id' => 'exists:categories,id',
            'status' => '',
            'name_ru' => '',
            'name_kz' => '',
            'count' => '',
            'price' => '',
            'link' => 'url',
            'video' => '',
            'video_link' => '',
            'description_ru' => '',
            'description_kz' => '',
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

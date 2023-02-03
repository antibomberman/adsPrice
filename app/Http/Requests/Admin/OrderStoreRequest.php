<?php

namespace App\Http\Requests\Admin;

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
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'status' => '',
            'name_ru' => 'required',
            'name_kz' => 'required',
            'count' => 'required|integer',
            'price' => 'required|numeric',
            'link' => 'required|url',
            'video' => 'file',
            'video_link' => 'string',
            'description_kz' => 'string',
            'description_ru' => 'string',
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

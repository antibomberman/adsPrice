<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserUpdateRequest extends FormRequest
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
            'phone' => '',
            'name' => 'string',
            'password' => '',
            'avatar' => 'image',
            'category_id' => 'exists:categories,id',
            'role_id' => 'exists:roles,id',
            'status' => '',
            'description_kz' => 'string',
            'description_ru' => 'string',
            'is_agree' => '',
            'manager_id' => '',
            'show_tasks' => 'in:1,0'
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

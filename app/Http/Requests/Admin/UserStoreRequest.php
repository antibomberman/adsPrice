<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserStoreRequest extends FormRequest
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
            'phone' => 'required|unique:users',
            'name' => 'required',
            'avatar' => 'image',
            'category_id' => 'required|exists:categories,id',
            'role_id' => 'required|exists:roles,id',
            'status' => '',
            'password' => 'required',
            'description_ru' => 'string',
            'description_kz' => 'string',
            'manager_id' => 'exists:users,id'
        ];
    }

    public function messages()
    {
        return [
            'phone.unique' => 'Данный номер телефона занят'
        ];
    }

    public function failedValidation( $validator)
    {
        throw new HttpResponseException(
            response()->json(['message' => $validator->errors()->first()],400)
        );
    }
}

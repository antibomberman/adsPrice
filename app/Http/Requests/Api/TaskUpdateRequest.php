<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TaskUpdateRequest extends FormRequest
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
            'name' => '',
            'status' => '',
            'price' => 'numeric',
            'description' => 'string',
            'text_1' => 'string',
            'text_2' => 'string'
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

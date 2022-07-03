<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetailRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'sometimes|string',
            'name' => 'sometimes|string',
            'phone' => 'sometimes|string',
            'street' => 'sometimes|string',
            'province' => 'sometimes|string',
            'city' => 'sometimes|string',
            'district' => 'sometimes|string',
            'postal' => 'sometimes|string',
            'addition' => 'sometimes|string',
        ];
    }
}

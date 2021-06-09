<?php

namespace App\Http\Requests\ShopRequest;

use App\Http\Requests\FormRequest;

class CreateShopRequest extends FormRequest
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
            'name' => 'required|string|unique:shops,name',
            'query' => 'required|string',
            'latitude' => 'required|regex:/^\d{1,2}(\.\d{1,8})?$/',
            'longitude' => 'required|regex:/^\d{1,2}(\.\d{1,8})?$/',
            'zoom' => 'required|integer'
        ];
    }
}

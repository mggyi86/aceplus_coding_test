<?php

namespace App\Http\Requests\CouponRequest;

use App\Http\Requests\FormRequest;

class CreateCouponRequest extends FormRequest
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
            'name' => 'required|string|unique:coupons,name',
            'description' => 'required|string',
            'discount_type' => 'required|string|in:percentage,fix-amount',
            'amount' => 'required|integer',
            'image_url' => 'required|string',
            'code' => 'required|integer',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'coupon_type' => 'required|string|in:private,public',
            'used_count' => 'required|integer'
        ];
    }
}

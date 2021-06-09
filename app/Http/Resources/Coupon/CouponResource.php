<?php

namespace App\Http\Resources\Coupon;

use App\Http\Resources\Shop\ShopCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'admin_id' => $this->admin_id,
            'name' => $this->name,
            'description' => $this->description,
            'discount_type' => $this->discount_type,
            'amount' => $this->amount,
            'image_url' => $this->image_url,
            'code' => $this->code,
            'start_datetime' => optional($this->start_datetime)->format('Y-m-d H:i:s'),
            'end_datetime' => optional($this->end_datetime)->format('Y-m-d H:i:s'),
            'coupon_type' => $this->coupon_type,
            'used_count' => $this->used_count,
            'created_at' => optional($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => optional($this->updated_at)->format('Y-m-d H:i:s'),
            'shops' => ShopCollection::make($this->whenLoaded('shops'))
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'success' => 1,
            'code'  => 200,
            'duration' => microtime(true) - LARAVEL_START
        ];
    }
}

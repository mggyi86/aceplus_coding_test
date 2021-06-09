<?php

namespace App\Http\Resources\Shop;

use App\Http\Resources\Coupon\CouponCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
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
            'query' => $this->query,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'zoom' => $this->zoom,
            'coupons' => CouponCollection::make($this->whenLoaded('coupons')),
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

<?php

namespace App\Http\Controllers;

use App\Shop;
use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\Shop\ShopResource;
use App\Http\Resources\Shop\ShopCollection;
use App\Http\Resources\Coupon\CouponResource;
use App\Http\Resources\Coupon\CouponCollection;

class ShopCouponController extends Controller
{
    /**
     * Get All Coupons for Specific Shop.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function getCoupons(Shop $shop)
    {
        $coupons = $shop->coupons()->paginate(30);
        return new CouponCollection($coupons);
    }

    /**
     * Get Coupon detail.
     *
     * @param  \App\Shop  $shop
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function getCouponDetail(Shop $shop, Coupon $coupon)
    {
        return new CouponResource($coupon);
    }

    /**
     * Create Coupon for shop.
     *
     * @param  \App\Shop  $shop
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function createCoupon(Shop $shop, Coupon $coupon)
    {
        $shop->coupons()->attach($coupon->id);
        return new ShopResource($shop->load(['coupons']));
    }


    /**
     * Delete Coupon for shop.
     *
     * @param  \App\Shop  $shop
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function deleteCoupon(Shop $shop, Coupon $coupon)
    {
        $shop->coupons()->detach($coupon->id);
        return new ShopResource($shop->load(['coupons']));
    }
}

<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('{shop}/coupons', 'ShopCouponController@getCoupons');
Route::post('{shop}/coupons/{coupon}', 'ShopCouponController@createCoupon');
Route::delete('{shop}/coupons/{coupon}', 'ShopCouponController@deleteCoupon');
Route::get('{shop}/coupons/{coupon}', 'ShopCouponController@getCouponDetail');
Route::apiResource('shops', 'ShopController');
Route::apiResource('coupons', 'CouponController');

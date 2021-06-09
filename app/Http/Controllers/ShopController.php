<?php

namespace App\Http\Controllers;

use App\Shop;
use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\ShopRepository;
use App\Http\Resources\Shop\ShopResource;
use App\Http\Resources\Shop\ShopCollection;
use App\Http\Resources\Coupon\CouponResource;
use App\Http\Resources\Coupon\CouponCollection;
use App\Http\Requests\ShopRequest\CreateShopRequest;
use App\Http\Requests\ShopRequest\UpdateShopRequest;

class ShopController extends Controller
{
    /**
     * @var ShopRepository
     */
    protected $shopRepository;

    /**
     * ShopController constructor.
     *
     * @param ShopRepository $shopRepository
     */
    public function __construct(ShopRepository $shopRepository)
    {
        $this->shopRepository = $shopRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $shops = $this->shopRepository->all();
        $shops = Shop::with('coupons')->paginate(30);

        return new ShopCollection($shops);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateShopRequest $request)
    {
        $shop = $this->shopRepository->create($request->all());

        return new ShopResource($shop);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        return new ShopResource($shop->load(['coupons']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShopRequest $request, Shop $shop)
    {
        $shop = $this->shopRepository->update($shop, $request->all());

        return new ShopResource($shop);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $this->shopRepository->destroy($shop);

        return response()->json([ 'success' => 1, 'code'  => 200 ], Response::HTTP_OK);
    }
}

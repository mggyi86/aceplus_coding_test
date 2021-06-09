<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\CouponRepository;
use App\Http\Resources\Coupon\CouponResource;
use App\Http\Resources\Coupon\CouponCollection;
use App\Http\Requests\CouponRequest\CreateCouponRequest;
use App\Http\Requests\CouponRequest\UpdateCouponRequest;

class CouponController extends Controller
{
    /**
     * @var CouponRepository
     */
    protected $couponRepository;

    /**
     * CouponController constructor.
     *
     * @param CouponRepository $couponRepository
     */
    public function __construct(CouponRepository $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $coupons = $this->couponRepository->all();
        $coupons = Coupon::with('shops')->paginate(30);

        return new CouponCollection($coupons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCouponRequest $request)
    {
        $coupon = $this->couponRepository->create($request->all());

        return new CouponResource($coupon);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        return new CouponResource($coupon->load(['shops']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        $coupon = $this->couponRepository->update($coupon, $request->all());

        return new CouponResource($coupon);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $this->couponRepository->destroy($coupon);

        return response()->json([ 'success' => 1, 'code' => 200 ], Response::HTTP_OK);
    }
}

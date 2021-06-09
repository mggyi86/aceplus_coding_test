<?php

namespace App\Repositories;

use App\Coupon;
use App\Repositories\BaseRepository;

class CouponRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Coupon::class;
    }

    /**
     * @param array $data
     *
     * @return Coupon
     */
    public function create(array $data) : Coupon
    {
        return Coupon::create([
            'admin_id' => 1,  //should assign current admin auth()->user()->id
            'name' => $data['name'],
            'description' => $data['description'],
            'discount_type' => $data['discount_type'],
            'amount' => $data['amount'],
            'image_url' => $data['image_url'],
            'code' => $data['code'],
            'start_datetime' => $data['start_datetime'],
            'end_datetime' => $data['end_datetime'],
            'coupon_type' => $data['coupon_type'],
            'used_count' => $data['used_count']
        ]);
    }

    /**
     * @param Coupon  $coupon
     * @param array $data
     *
     * @return mixed
     */
    public function update(Coupon $coupon, array $data) : Coupon
    {
        $coupon->name = isset($data['name']) ? $data['name'] : $coupon->name;
        $coupon->description = isset($data['description']) ? $data['description'] : $coupon->description;
        $coupon->discount_type = isset($data['discount_type']) ? $data['discount_type'] : $coupon->discount_type;
        $coupon->amount = isset($data['amount']) ? $data['amount'] : $coupon->amount;
        $coupon->image_url = isset($data['image_url']) ? $data['image_url'] : $coupon->image_url;
        $coupon->code = isset($data['code']) ? $data['code'] : $coupon->code;
        $coupon->start_datetime = isset($data['start_datetime']) ? $data['start_datetime'] : $coupon->start_datetime;
        $coupon->end_datetime = isset($data['end_datetime']) ? $data['end_datetime'] : $coupon->end_datetime;
        $coupon->coupon_type = isset($data['coupon_type']) ? $data['coupon_type'] : $coupon->coupon_type;
        $coupon->used_count = isset($data['used_count']) ? $data['used_count'] : $coupon->used_count;

        if ($coupon->isDirty()) {
            $coupon->save();
        }

        return $coupon->refresh();
    }


    /**
     * @param Coupon $coupon
     */
    public function destroy(Coupon $coupon)
    {
        $deleted = $this->deleteById($coupon->id);

        if ($deleted) {
            $coupon->save();
        }
    }
}

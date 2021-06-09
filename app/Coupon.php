<?php

namespace App;

use App\Shop;
use App\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupons';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id',
        'name',
        'description',
        'discount_type',
        'amount',
        'image_url',
        'code',
        'start_datetime',
        'end_datetime',
        'coupon_type',
        'used_count'
    ];

    /**
     * Relations
     */
    public function shops()
    {
        return $this->belongsToMany(Shop::class, 'coupon_shops', 'coupon_id', 'shop_id')->withTimestamps();
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}

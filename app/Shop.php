<?php

namespace App;

use App\Coupon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'shops';

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
        'query',
        'latitude',
        'longitude',
        'zoom'
    ];

    /**
     * Relations
     */
    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_shops', 'shop_id', 'coupon_id')->withTimestamps();
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}

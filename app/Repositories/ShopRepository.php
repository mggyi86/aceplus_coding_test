<?php

namespace App\Repositories;

use App\Shop;
use App\Repositories\BaseRepository;

class ShopRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Shop::class;
    }

    /**
     * @param array $data
     *
     * @return Shop
     */
    public function create(array $data) : Shop
    {
        return Shop::create([
            'admin_id' => 1,  //should assign current admin auth()->user()->id
            'name' => $data['name'],
            'query' => $data['query'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'zoom' => $data['zoom'],
        ]);
    }

    /**
     * @param Shop  $shop
     * @param array $data
     *
     * @return mixed
     */
    public function update(Shop $shop, array $data) : Shop
    {
        $shop->name = isset($data['name']) ? $data['name'] : $shop->name;
        $shop->query = isset($data['query']) ? $data['query'] : $shop->query;
        $shop->latitude = isset($data['latitude']) ? $data['latitude'] : $shop->latitude;
        $shop->longitude = isset($data['longitude']) ? $data['longitude'] : $shop->longitude;
        $shop->zoom = isset($data['zoom']) ? $data['zoom'] : $shop->zoom;

        if ($shop->isDirty()) {
            $shop->save();
        }
        return $shop->refresh();
    }


    /**
     * @param Shop $shop
     */
    public function destroy(Shop $shop)
    {
        $deleted = $this->deleteById($shop->id);

        if ($deleted) {
            $shop->save();
        }
    }
}

<?php

namespace App\Repositories;


use App\Models\Coupon;

class CouponRepository implements CouponRepositoryInterface
{
    public function all()
    {
        return Coupon::all();
    }

    public function create(array $data)
    {
        return Coupon::create($data);
    }

    public function update(array $data, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update($data);
        return $coupon;
    }

    public function delete($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
    }

    public function find($id)
    {
        return Coupon::findOrFail($id);
    }
}
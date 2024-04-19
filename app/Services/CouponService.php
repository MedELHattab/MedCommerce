<?php

namespace App\Services;

use App\Repositories\CouponRepositoryInterface;

class CouponService
{
    public function __construct(
        protected CouponRepositoryInterface $couponRepository
    ) {
    }

    public function create(array $data)
    {
        return $this->couponRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->couponRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->couponRepository->delete($id);
    }

    public function all()
    {
        return $this->couponRepository->all();
    }

    public function find($id)
    {
        return $this->couponRepository->find($id);
    }
}

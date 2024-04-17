<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;

class ProductService
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    ) {
    }

    public function create(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->productRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }

    public function all()
    {
        return $this->productRepository->all();
    }

    public function find($id)
    {
        return $this->productRepository->find($id);
    }

}

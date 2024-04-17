<?php

namespace App\Services;

use App\Repositories\CategoryRepositoryInterface;

class CategoryService
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository
    ) {
    }

    public function create(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->categoryRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->categoryRepository->delete($id);
    }

    public function all()
    {
        return $this->categoryRepository->all();
    }
    
    public function find($id)
    {
        return $this->categoryRepository->find($id);
    }
}
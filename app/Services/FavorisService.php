<?php

namespace App\Services;

use App\Repositories\FavorisRepositoryInterface;

class FavorisService
{
    public function __construct(
        protected FavorisRepositoryInterface $favorisRepository
    ) {
    }

    public function create(array $data)
    {
        return $this->favorisRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->favorisRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->favorisRepository->delete($id);
    }

    public function all()
    {
        return $this->favorisRepository->all();
    }

    public function find($id)
    {
        return $this->favorisRepository->find($id);
    }
}

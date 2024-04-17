<?php

namespace App\Services;

use App\Repositories\CommentRepositoryInterface;

class CommentService
{
    public function __construct(
        protected CommentRepositoryInterface $commentRepository
    ) {
    }

    public function create(array $data)
    {
        return $this->commentRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->commentRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->commentRepository->delete($id);
    }

    public function all()
    {
        return $this->commentRepository->all();
    }

    public function find($id)
    {
        return $this->commentRepository->find($id);
    }
}

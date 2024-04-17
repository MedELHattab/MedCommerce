<?php

namespace App\Services;

use App\Repositories\HomeRepositoryInterface;

class HomeService
{
    public function __construct(
        protected HomeRepositoryInterface $homeRepository
    ) {
    }

    public function all()
    {
        return $this->homeRepository->all();
    }
}

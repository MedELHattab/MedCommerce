<?php
namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(array $data);

    public function findByEmail(string $email);
}
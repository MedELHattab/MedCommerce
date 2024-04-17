<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);

    
    public function addProducttoCart($id);
    
     
    public function updateCart($id, $quantity);
    
   
    public function deleteProduct($id);
    
}
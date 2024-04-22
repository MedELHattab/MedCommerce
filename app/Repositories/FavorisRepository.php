<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Auth;



use App\Models\Favoris;

class FavorisRepository implements FavorisRepositoryInterface
{
    public function all()
    {
        return Favoris::all();
    }

    public function create(array $data)
    {
        return Favoris::create($data);
    }

    public function update(array $data, $id)
    {
        $favoris = Favoris::findOrFail($id);
        $favoris->update($data);
        return $favoris;
    }

    public function delete($id)
    {
        $favoris = Favoris::findOrFail($id);
        $favoris->delete();
    }

    public function find($id)
    {
        return Favoris::findOrFail($id);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description','price', 'category_id','image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function details()
    {
        return $this->hasMany(Detail::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function Favoris()
    {
        return $this->hasMany(Favoris::class);
    }
}


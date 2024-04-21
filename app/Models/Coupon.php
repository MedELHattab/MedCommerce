<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'percentage_discount',
        'usage_limit',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_coupon', 'coupon_id', 'user_id')->withTimestamps();
    }
}
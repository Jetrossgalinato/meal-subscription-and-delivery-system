<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'image'];
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}

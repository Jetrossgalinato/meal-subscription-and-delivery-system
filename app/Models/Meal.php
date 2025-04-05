<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'image'];

    protected $appends = ['image_url']; // 👈 This makes image_url appear in JSON

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image); // Adjust path if needed
    }
}

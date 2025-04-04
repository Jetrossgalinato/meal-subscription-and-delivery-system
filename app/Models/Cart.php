<?php
// filepath: c:\xampp\htdocs\IT-111 Final Project\meal-subscription\app\Models\Cart.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'meal_id', 'quantity'];

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
}

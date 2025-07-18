<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'menu_item_id', 'quantity'];

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }
}

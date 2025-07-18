<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $table = 'menu_items';

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'price',
        'image',
        'availability',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    protected $casts = [
        'availability' => 'boolean',
        'price' => 'float',
    ];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}

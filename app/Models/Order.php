<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'delivery_id',
        'payment_status',
        'order_status',
        'total_amount',
        'delivery_type',
        'table_no',
        'delivery_address',
    ];

    /**
     * Relationship: Order belongs to a customer (user)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Relationship: Order optionally belongs to a delivery person (also a user)
     */
    public function deliveryGuy()
    {
        return $this->belongsTo(User::class, 'delivery_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'stripe_payment_id',
        'status',
        'amount',
        'paid_at'
    ];

    protected $dates = ['paid_at'];
}

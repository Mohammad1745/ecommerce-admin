<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_code', 'user_id', 'total_price', 'payment_method', 'payment_status', 'delivery_status'];
}

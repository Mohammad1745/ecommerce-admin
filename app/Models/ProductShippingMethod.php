<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductShippingMethod extends Model
{
    protected $fillable = ['product_id', 'shipping_method'];
}

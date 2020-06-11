<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'brand_id', 'regular_price', 'sell_price', 'quantity'];
}

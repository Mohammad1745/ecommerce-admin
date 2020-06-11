<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlashSaleProduct extends Model
{
    protected $fillable = ['product_id', 'expires_at', 'flash_sale_price'];
}

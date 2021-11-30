<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'qty',
        'unit_price',
        'unit_discount_amount',
        'product_id',
        'order_id',
    ];

    public function order(){
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}

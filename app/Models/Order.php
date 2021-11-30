<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'initial_amount',
        'discount_amount',
        'amount',
        'city',
        'address',
        'transaction_id',
        'currency',
        'payment_method',
        'status',
        'user_id',
        'delivered_at'
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}

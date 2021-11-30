<?php

namespace App\Traits;

use App\Models\OrderItem;

trait TopSellingProducts{
    
    protected function getTopSellingProducts(){
        $products = OrderItem::with('product')
                          ->join('orders', 'order_id', 'orders.id')
                          ->selectRaw('order_items.product_id, 
                                      SUM(order_items.qty) AS total_sold_qty')
                          ->whereRaw("(orders.status='Confirmed' OR 
                                       orders.status='Delivered')")
                          ->whereNull('orders.deleted_at')
                          ->groupBy('order_items.product_id')
                          ->orderBy('total_sold_qty', 'desc')
                          ->get(); 
        return $products;                          
    }

}
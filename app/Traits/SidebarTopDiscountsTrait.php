<?php

namespace App\Traits;

use App\Models\Product;

trait SidebarTopDiscountsTrait{
    
    protected function getTopDiscountProducts(){
        $products = Product::where('status', 1)
                           ->where('deleted_at', null)
                           ->whereNotNull('discount')
                           ->where('quantity', '>', 0)
                           ->orderBy('discount', 'desc')
                           ->limit(5)
                           ->get();
        return $products;                  
    }


}
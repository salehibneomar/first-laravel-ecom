<?php

namespace App\Traits;

use App\Models\Category;

trait NavbarTrait{
    
    protected function getCategories(){
        $categories = Category::where('parent_id', null)
                              ->where('status', 1)
                              ->orderBy('id')
                              ->get();
        return $categories;                        
    }


}
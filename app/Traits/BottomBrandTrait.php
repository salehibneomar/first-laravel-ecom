<?php

namespace App\Traits;

use App\Models\Brand;

trait BottomBrandTrait{
    
    protected function getBrands(){
        $brands = Brand::join('products', 'brands.id', '=', 'products.brand_id')
                ->selectRaw('brands.id, brands.name, brands.image, count(products.id) as products_count')
                ->where('products.status', 1)
                ->whereNull('products.deleted_at')
                ->whereNull('brands.deleted_at')
                ->groupBy(['brands.id', 'brands.name', 'brands.image'])
                // ->orderBy('products_count', 'desc')
                // ->having('products_count', '>', '10')
                ->limit(12)
                ->get();

        return $brands;
    }


}
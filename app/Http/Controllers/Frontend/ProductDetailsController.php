<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Traits\BottomBrandTrait;
use App\Traits\NavbarTrait;
use App\Traits\SidebarTopDiscountsTrait;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductDetailsController extends Controller
{

    use NavbarTrait, SidebarTopDiscountsTrait, BottomBrandTrait;

    public function index($id, $slug){
        $menuCategories      = $this->getCategories();
        $topDiscountProducts = $this->getTopDiscountProducts();
        $topBrands           = $this->getBrands();
        $product             = Product::where('status', 1)
                                      ->where('quantity', '>', 0)
                                      ->whereNull('deleted_at')
                                      ->findOrFail($id);

        return view('frontend.pages.product-details', 
        compact('menuCategories', 
                'topDiscountProducts', 
                'topBrands', 
                'product'));
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Traits\NavbarTrait;
use App\Models\BannerSlider;
use App\Models\Product;
use App\Traits\BottomBrandTrait;
use App\Traits\SidebarTopDiscountsTrait;
use App\Traits\TopSellingProducts;

class HomeController extends Controller
{
    use NavbarTrait, SidebarTopDiscountsTrait, BottomBrandTrait, TopSellingProducts;

    public function getBannerSliders(){
        $bannerSlider = BannerSlider::where('status', 1)->orderBy('id', 'desc')->get();
        return $bannerSlider;
    }

    public function getNewProducts(){
        $products = Product::whereRaw(" (status=1 AND quantity>0 AND deleted_at IS NULL) OR 
        (status=1 AND products.condition='new' AND products.quantity>0 AND deleted_at IS NULL)")
                           
                           ->orderByRaw("FIELD(products.condition, 'new', 'hot', 'normal', 'sale') ASC ")
                           ->orderBy('updated_at', 'desc')
                           ->limit(20)
                           ->get();
        return $products;
    }

    public function getFeaturedProducts(){
        $products = Product::where('status', 1)
                           ->where('deleted_at', null)
                           ->where('is_featured', 1)
                           ->where('quantity', '>', 0)
                           ->orderBy('id', 'desc')
                           ->limit(20)
                           ->get();
        return $products;                  
    }

    public function index(){
        $menuCategories      = $this->getCategories();
        $bannerSlider        = $this->getBannerSliders();
        $newProducts         = $this->getNewProducts();
        $featuredProducts    = $this->getFeaturedProducts();
        $topDiscountProducts = $this->getTopDiscountProducts();
        $topBrands           = $this->getBrands();
        $bestSellers         = $this->getTopSellingProducts()->slice(0, 20);

        return view('index', 
               compact('menuCategories', 
                       'bannerSlider', 
                       'newProducts',
                       'featuredProducts',
                       'topDiscountProducts',
                        'topBrands',
                        'bestSellers'));
    }
}

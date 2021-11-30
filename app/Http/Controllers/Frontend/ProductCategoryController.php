<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Traits\NavbarTrait;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{

    use NavbarTrait;

    public function index(Request $request, $id, $slug)
    {
        // dd($request->all());
        $clickedCategory     = Category::findOrFail($id);
        $clickedCategoryName = $clickedCategory->name;
        $menuCategories  = $this->getCategories();
        $allBrandSidebar = Brand::withoutTrashed()->latest()->get();

        $categoryIds = array($clickedCategory->id);

        if(!is_null($clickedCategory->subcategories)){
            foreach($clickedCategory->subcategories as $sub){
                $categoryIds[] = $sub->id;
            }
        }

        $orderValues = array('price.asc'=>'Price: Low - High', 
                             'price.desc'=>'Price: High - Low', 
                             'discount.desc'=>'Discount: High - Low');

        $limitValues = array('20'=>'20', '50'=>'50');
        
        $conditionValues = array('new'=>'New', 'sale'=>'Sale', 'hot'=>'Hot');

        $requestParam = null;
        $orderBy = 'updated_at';
        $order   = 'desc';
        $limit   = 6;

        $categoryProducts = Product::query();
        $categoryProducts = $categoryProducts
                          ->where('status', 1)
                          ->whereNull('deleted_at')
                          ->where('quantity', '>', 0)
                          ->whereIn('category_id', $categoryIds);

        if(!empty($request->all()) && count($request->all())>1){
            
            $requestParam = $request->all();

            if($request->has('orderBy') && array_key_exists($request->orderBy, $orderValues)){
                $value   = explode('.', $request->orderBy);
                $orderBy = $value[0];
                $order   = $value[1];
            }

            if($request->has('limit') && array_key_exists($request->limit, $limitValues)){
                $limit = $request->limit;
            }

            if($request->has('brand')){
                $brandIds = array();
                foreach($request->brand as $brand){
                    $brandIds[] = $brand;
                }
                $categoryProducts = $categoryProducts
                                  ->whereIn('brand_id', $brandIds);
            }

            if($request->has('condition') && array_key_exists($request->condition, $conditionValues)){
                $categoryProducts = $categoryProducts
                                  ->where('condition', $request->condition);
            }

            if($request->has('price_from') && is_numeric($request->price_from)){
                $categoryProducts = $categoryProducts
                                  ->where('price', '>=', $request->price_from);
            }

            if($request->has('price_to') && is_numeric($request->price_to)){
                $categoryProducts = $categoryProducts
                                  ->where('price', '<=', $request->price_to);
            }
        }

        $categoryProducts = $categoryProducts
                          ->orderBy($orderBy, $order)
                          ->paginate($limit)->withQueryString();

        return view('frontend.pages.product-category', 
            compact('clickedCategoryName',
                    'menuCategories',
                    'allBrandSidebar',
                    'categoryProducts',
                    'requestParam',
                    'orderValues',
                    'limitValues',
                    'conditionValues'));
    }
}

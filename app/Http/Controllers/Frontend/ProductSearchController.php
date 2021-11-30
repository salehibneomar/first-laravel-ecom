<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\NavbarTrait;

class ProductSearchController extends Controller
{
    use NavbarTrait;
    
    public function index(Request $request)
    {
        if(!$request->has('q') || !$request->filled('q')){
            return back();
        }
        
        $key = $request->q;

        $menuCategories = $this->getCategories();

        $orderValues = array('price.asc'=>'Price: Low - High', 
                             'price.desc'=>'Price: High - Low', 
                             'discount.desc'=>'Discount: High - Low');

        $limitValues = array('20'=>'20', '50'=>'50');
        
        $requestParam = null;
        $orderBy = 'updated_at';
        $order   = 'desc';
        $limit   = 6;

        $searchedProducts = Product::query();
        $searchedProducts = $searchedProducts
                            ->where('status', 1)
                            ->where('quantity', '>', 0)
                            ->where('title', 'LIKE', '%'.$key.'%');

        if(count($request->all())>2){

            $requestParam = $request->all();
            
            if($request->has('orderBy') && array_key_exists($request->orderBy, $orderValues)){
                $value   = explode('.', $request->orderBy);
                $orderBy = $value[0];
                $order   = $value[1];
            }

            if($request->has('limit') && array_key_exists($request->limit, $limitValues)){
                $limit = $request->limit;
            }
        }
        
        $searchedProducts = $searchedProducts
                          ->orderBy($orderBy, $order)
                          ->paginate($limit)->withQueryString();

        $totalData = $searchedProducts->total();

        return view('frontend.pages.product-search', 
                compact('menuCategories', 
                        'orderValues', 
                        'limitValues',
                        'key',
                        'requestParam',
                        'searchedProducts',
                        'totalData'));
    }

    
}

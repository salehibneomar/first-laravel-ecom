<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\NavbarTrait;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class ProductCartController extends Controller
{
    use NavbarTrait;

    public function addOnTheFly($id, $slug){
        
        $product = Product::where('status', 1)
                            ->where('quantity', '>', 0)
                            ->whereNull('deleted_at')
                            ->findOrFail($id);

        $cart = Cart::content();
        $exists = false;
        $addedItem = false;
        
        if($cart->isNotEmpty()){

            $findSingle = $cart->where('id', $id);

            if($findSingle->isNotEmpty()){
                $exists = true;

                if($findSingle->first()->qty>=10){
                    return back()->with('alertMsg', 'You cannot add more than 10 quantity of a same item!');
                }

                $addedItem = Cart::update($findSingle->first()->rowId, $findSingle->first()->qty+1);
            }
        }
        
        if(!$exists){
        $addedItem = Cart::add([
                    'id' => $product->id, 
                    'name' => $product->title, 
                    'qty' => 1, 
                    'price' => $product->price, 
                    'weight' => 1,
                    'options' => [
                        'image' => $product->image,
                        'discount' => $product->discount,
                        'slug'     => $product->slug
                    ]
                ]);
        }                

        if($addedItem){

            if(!is_null($product->discount) && !$exists){
                Cart::setDiscount($addedItem->rowId, $product->discount);
            }
            
            $alert = array('alertType'=> 'success', 'alertMsg'=>'Item added to cart successfully!');
            return back()->with($alert);
        }
        
        return back()->with('alertMsg', 'Error occured!');

    }

    public function addFromDetailsPage(Request $request, $id){

        $product = Product::where('status', 1)
                            ->where('quantity', '>', 0)
                            ->whereNull('deleted_at')
                            ->findOrFail($id);

        $validated = $request->validate(['qty'=>'required|integer|min:1|max:10']);   
    
        // Cart::destroy();

        $cart = Cart::content();
        $exists = false;
        $addedItem = false;

        if($cart->isNotEmpty()){
            $findSingle = $cart->where('id', $id);

            if($findSingle->isNotEmpty()){
                $exists = true;

                if((($findSingle->first()->qty)+$request->qty)>10){
                    return back()->with('alertMsg', 'You cannot add more than 10 quantity of a same item!');
                }
                
                $addedItem = Cart::update($findSingle->first()->rowId, $findSingle->first()->qty+$request->qty);
            }
        }

        
        if(!$exists){
            $addedItem = Cart::add([
                'id' => $product->id, 
                'name' => $product->title, 
                'qty' => $request->qty, 
                'price' => $product->price, 
                'weight' => 1,
                'options' => [
                    'image' => $product->image,
                    'discount' => $product->discount,
                    'slug'     => $product->slug
                ]
            ]);
        }

        

        if($addedItem){

            if(!is_null($product->discount) && !$exists){
                Cart::setDiscount($addedItem->rowId, $product->discount);
            }

            $alert = array('alertType'=> 'success', 'alertMsg'=>'Item added to cart successfully!');

            return back()->with($alert);
        }

        return back()->with('alertMsg', 'Error occured!');

    }

    public function removeItem($rowId){
        $cart = Cart::content();
        if($cart->isEmpty()){
            return redirect()->route('page.landing')->with('alertMsg', 'Cart Empty!');
        }

        try{
            Cart::remove($rowId);
        }
        catch(Exception $e){
            return redirect()->route('page.landing')->with('alertMsg', 'Invalid Item!');
        }

        $alert = array('alertType'=> 'success', 'alertMsg'=>'Item removed from cart successfully!');

        return back()->with($alert);
    }

    public function viewAll(){

        if(Cart::count()==0){
            return redirect()->route('page.landing')->with('alertMsg', 'Cart is empty!');
        }

        $menuCategories  = $this->getCategories();
        return view('frontend.pages.shopping-cart', compact('menuCategories'));
    }

    public function update(Request $request, $rowId){
        
        $validated = $request->validate([
            'qty' => 'required|integer|min:1|max:10',
            'rowId' => 'required'
        ],
        [
            'qty.required' => 'The quantity field is required!'
        ]);

        
        try{
            $item = Cart::get($rowId);

            $product = Product::where('status', 1)
                            ->where('quantity', '>', 0)
                            ->whereNull('deleted_at')
                            ->findOrFail($item->id);

            if(($item->qty+$request->qty)>10){
                return back()->with('alertMsg', 'You cannot add more than 10 quantity of a same item!');
            }

            Cart::update($item->rowId, $item->qty+$request->qty);
        }
        catch(Exception $e){
            return redirect()->route('page.landing')->with('alertMsg', 'Invalid Item!');
        }

        $alert = array('alertType'=> 'success', 'alertMsg'=>'Item updated successfully!');

        return back()->with($alert);
    }

}

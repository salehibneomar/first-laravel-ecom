<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\ShippingDivision;
use App\Traits\NavbarTrait;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\OrderItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class CheckOutController extends Controller
{
    use NavbarTrait;


    public function index(){

        if($this->check()){
            return redirect()->route($this->check()['route'])->with('alertMsg', $this->check()['msg']);
        }

        $divisions = ShippingDivision::all();
        $menuCategories = $this->getCategories();
        return view('frontend.pages.checkout-offline', compact('divisions', 'menuCategories'));
    }

    public function storeOrder(Request $request){

        $validated = $request->validate([
            'name'    => 'required|min:3|max:150',
            'email'   => 'required|email',
            'phone'   => 'required',
            'city'    => 'required',
            'address' => 'required'
        ]);

        $trans_id = 'TRX_'.Str::upper(uniqid());

        $order_id = Order::insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'initial_amount' => (double)Str::replace(',', '', Cart::priceTotal(2)),
            'discount_amount' => (double)Str::replace(',', '', Cart::discount(2)),
            'amount' => (double)Str::replace(',', '', Cart::total(2)),
            'city' => $request->city,
            'address' => $request->address,
            'status' => 'Pending',
            'payment_method'=> 'cash on delivery',
            'user_id' => Auth::guard('web')->user()->id,
            'transaction_id' => $trans_id,
            'currency' => 'BDT',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $emailData = array(
            'trans_id' => $trans_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'initial_amount' => (double)Str::replace(',', '', Cart::priceTotal(2)),
            'discount_amount' => (double)Str::replace(',', '', Cart::discount(2)),
            'amount' => (double)Str::replace(',', '', Cart::total(2)),
            'city' => $request->city,
            'address' => $request->address,
            'status' => 'Pending',
            'payment_method'=> 'cash on delivery',
            'currency' => 'BDT',
        );

        $oderItems = array();
        
        foreach(Cart::content() as $item){
            $singleItem = array(
            'product_id' => $item->id,
            'qty'        => $item->qty,
            'unit_price' => $item->price,
            'unit_discount_amount' => !is_null($item->options->discount) ? $item->options->discount: null,
            'order_id'   => $order_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            );

            array_push($oderItems, $singleItem);
        }

        if(!empty($oderItems) && $order_id){
            OrderItem::insert($oderItems);
            Cart::destroy();
        }

        if($order_id){
            Mail::to($request->email)->send(new OrderMail($emailData));
        }

        $alert = array('alertType'=>'success', 'alertMsg'=>'Order placed successfully, you will get a call from one of our representitive soon!');

        return redirect()->route('account.orders')->with($alert);
    }

    protected function check(){
        if(Cart::count()==0){
            return array('route'=>'page.landing', 'msg'=>'Cart is empty!');
        }
        if(!(Auth::guard('web')->check())){
            return array('route'=>'login', 'msg'=>'You have to login first to procced checkout!');
        }
        return false;
    }
}

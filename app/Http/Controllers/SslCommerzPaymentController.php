<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\OrderItem;
use App\Traits\NavbarTrait;
use App\Models\ShippingDivision;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use App\Mail\OrderOnlineSuccessfull;

class SslCommerzPaymentController extends Controller
{

    use NavbarTrait;

    public function hostedCheckout()
    {
        if($this->check()){
            return redirect()->route($this->check()['route'])->with('alertMsg', $this->check()['msg']);
        }

        $divisions = ShippingDivision::all();
        $menuCategories = $this->getCategories();
        return view('frontend.pages.checkout-online', compact('divisions', 'menuCategories'));
    }

    public function index(Request $request)
    {

        $inputValidated = $request->validate([
            'name'    => 'required|min:3|max:150',
            'email'   => 'required|email',
            'phone'   => 'required',
            'city'    => 'required',
            'address' => 'required'
        ]);

        $post_data = array();
        $post_data['total_amount'] = (double)Str::replace(',', '', Cart::total(2)); # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = 'TRX_'.Str::upper(uniqid()); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = Str::title($request->name);
        $post_data['cus_email'] = $request->email;
        $post_data['cus_add1'] = $request->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = $request->city;
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $request->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.

        $newOrderId = DB::table('orders')
            ->insertGetId([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'initial_amount' => (double)Str::replace(',', '', Cart::priceTotal(2)),
                'discount_amount' => (double)Str::replace(',', '', Cart::discount(2)),
                'amount' => $post_data['total_amount'],
                'city' => $post_data['cus_city'],
                'address' => $post_data['cus_add1'],
                'status' => 'Pending',
                'payment_method'=> 'online',
                'user_id' => Auth::guard('web')->user()->id,
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $emailData = array(
                'trans_id' => $post_data['tran_id'],
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'initial_amount' => (double)Str::replace(',', '', Cart::priceTotal(2)),
                'discount_amount' => (double)Str::replace(',', '', Cart::discount(2)),
                'amount' => (double)Str::replace(',', '', Cart::total(2)),
                'city' => $request->city,
                'address' => $request->address,
                'status' => 'Pending',
                'payment_method'=> 'online',
                'currency' => 'BDT',
            );    

        $oderItems = array();
        
        foreach(Cart::content() as $item){
            $singleItem = array(
            'product_id' => $item->id,
            'qty'        => $item->qty,
            'unit_price' => $item->price,
            'unit_discount_amount' => !is_null($item->options->discount) ? $item->options->discount: null,
            'order_id'   => $newOrderId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            );

            array_push($oderItems, $singleItem);
        }

        if(!empty($oderItems) && $newOrderId){
            OrderItem::insert($oderItems);
        }

        if($newOrderId){
            Mail::to($request->email)->send(new OrderMail($emailData));
        }
    
        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }


    public function success(Request $request)
    {

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount', 'email')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */

                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                
                if($update_product>0){
                    Mail::to($order_detials->email)
                        ->send(new OrderOnlineSuccessfull($order_detials->transaction_id));
                }
                
                Cart::destroy();

                $alert = array('alertType'=>'success', 'alertMsg'=>'Transaction is successfully Completed');
                return redirect()->route('account.orders')->with($alert);

            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                echo "validation Fail";
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);

                return redirect()->route('account.orders')->with('alertMsg', 'Transaction cancelled!');

        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    echo "validation Fail";
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
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

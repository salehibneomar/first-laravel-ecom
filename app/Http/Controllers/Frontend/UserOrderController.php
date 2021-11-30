<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use PDF;

class UserOrderController extends Controller
{
    public function viewAllOrders(){
        $orders = Order::where('user_id', '=', Auth::guard('web')->user()->id)
                        ->whereNull('deleted_at')
                        ->orderByDesc('updated_at')
                        ->paginate(5);

        return view('frontend.user.myorders', compact('orders'));
    }

    public function viewOrderItems($orderId){
        $orderId = Order::select('id')
                        ->where('id', '=', base64_decode($orderId))
                        ->where('user_id', Auth::guard('web')->user()->id)
                        ->whereNull('deleted_at')
                        ->firstOrfail();

        $orderItems = OrderItem::where('order_id', '=', $orderId->id)
                                ->with('product')
                                ->paginate(3);
        return view('frontend.user.myorder-items', 
                compact('orderItems'));                        
    }

    public function downloadOrderInvoice($orderId){
        $orderId = base64_decode($orderId);
        $order = Order::with('orderItems')
                       ->where('id', '=', $orderId)
                       ->where('user_id', '=', Auth::guard('web')->user()->id)
                       ->whereNull('deleted_at')
                       ->firstOrFail();

        // return view('order-invoice', compact('order'));
        $invoicePDF = PDF::loadView('order-invoice', compact('order'))->setPaper('a4')->setOptions(
            [
                'tempDir' => public_path(),
                'chroot'  => public_path()
            ]
        );
        return $invoicePDF->download($order->transaction_id.'.pdf');
    }
}

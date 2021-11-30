<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use PDF;

class OrderController extends Controller
{
    public function processing(Request $request){

        if($request->ajax()){
            $orders = Order::with('user')
                           ->whereNull('deleted_at')
                           ->where('status', 'Processing')
                           ->get();
            
            $data = DataTables::of($orders)
                              ->editColumn('amount', 
                              '৳ {{ number_format($amount) }}')
                              ->editColumn('created_at', 
                              '{{ date("d M Y, h:i A", strtotime($created_at)) }}')
                              ->addColumn('user', function($row){
                                  return $row->user->name;
                              })
                              ->addColumn('action', function($row){
                                $view = '<a href="'.route('orders.details', ['id'=>$row->id]).'" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>';
                                return $view;
                              })
                              ->rawColumns(['action'])
                              ->make(true);
            return $data;                                 
        }

        return view('backend.order.processing');
    }

    public function pending(Request $request){

        if($request->ajax()){
            $orders = Order::with('user')
                           ->whereNull('deleted_at')
                           ->where('status', 'Pending')
                           ->get();
            
            $data = DataTables::of($orders)
                              ->editColumn('amount', 
                              '৳ {{ number_format($amount) }}')
                              ->editColumn('created_at', 
                              '{{ date("d M Y, h:i A", strtotime($created_at)) }}')
                              ->addColumn('user', function($row){
                                  return $row->user->name;
                              })
                              ->addColumn('action', function($row){
                                $view = '<a href="'.route('orders.details', ['id'=>$row->id]).'" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>';
                                return $view;
                              })
                              ->rawColumns(['action'])
                              ->make(true);
            return $data;                                 
        }

        return view('backend.order.pending');
    }

    public function delivered(Request $request){
        if($request->ajax()){
            $orders = Order::with('user')
                           ->whereNull('deleted_at')
                           ->where('status', 'Delivered')
                           ->get();
            
            $data = DataTables::of($orders)
                              ->editColumn('amount', 
                              '৳ {{ number_format($amount) }}')
                              ->editColumn('created_at', 
                              '{{ date("d M Y, h:i A", strtotime($created_at)) }}')
                              ->addColumn('user', function($row){
                                  return $row->user->name;
                              })
                              ->addColumn('action', function($row){
                                $view = '<a href="'.route('orders.details', ['id'=>$row->id]).'" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>';
                                return $view;
                              })
                              ->rawColumns(['action'])
                              ->make(true);
            return $data;                                 
        }
        return view('backend.order.delivered');
    }

    public function canceled(Request $request){
        if($request->ajax()){
            $orders = Order::with('user')
                           ->whereNull('deleted_at')
                           ->where('status', 'Canceled')
                           ->get();
            
            $data = DataTables::of($orders)
                              ->editColumn('amount', 
                              '৳ {{ number_format($amount) }}')
                              ->editColumn('created_at', 
                              '{{ date("d M Y, h:i A", strtotime($created_at)) }}')
                              ->addColumn('user', function($row){
                                  return $row->user->name;
                              })
                              ->addColumn('action', function($row){
                                $view = '<a href="'.route('orders.details', ['id'=>$row->id]).'" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>';
                                return $view;
                              })
                              ->rawColumns(['action'])
                              ->make(true);
            return $data;                                 
        }
        return view('backend.order.cancled');
    }

    public function confirmed(Request $request){
        if($request->ajax()){
            $orders = Order::with('user')
                           ->whereNull('deleted_at')
                           ->where('status', 'Confirmed')
                           ->get();
            
            $data = DataTables::of($orders)
                              ->editColumn('amount', 
                              '৳ {{ number_format($amount) }}')
                              ->editColumn('updated_at', 
                              '{{ date("d M Y, h:i A", strtotime($updated_at)) }}')
                              ->addColumn('user', function($row){
                                  return $row->user->name;
                              })
                              ->addColumn('action', function($row){
                                $view = '<a href="'.route('orders.details', ['id'=>$row->id]).'" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>';
                                return $view;
                              })
                              ->rawColumns(['action'])
                              ->make(true);
            return $data;                                 
        }
        return view('backend.order.confirmed');
    }

    public function viewDetails($id){
        $order = Order::with('user', 'orderItems')
                        ->whereNull('deleted_at')
                        ->where('id', $id)
                        ->firstOrFail();
        
        $STATUS = $STATUS = $this->_STATUS();

        return view('backend.order.details', compact('order', 'STATUS'));                
    }

    public function invoiceDownload($id){
        $order = Order::with('orderItems')
        ->whereNull('deleted_at')
        ->where('id', $id)
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

    public function changeStatus(Request $request, $id){

        $STATUS = $this->_STATUS();
        $order = Order::withoutTrashed()->findOrFail($id);

        $alert = array('alertMsg'=>'Invalid status selected!');

        if(in_array($request->status, $STATUS)){

            $order->status = $request->status;
            if($request->status=='Delivered'){
                $order->delivered_at = Carbon::now();
            }
            $order->save();

            $alert = array('alertType'=>'success', 'alertMsg'=>'Order status updated successfully!');
        }

        return redirect()->back()->with($alert);
    }

    public function confirm($id){
        $order = Order::with('orderItems')
                      ->whereNull('deleted_at')
                      ->where('id', $id)
                      ->firstOrFail();
        
        $order->status = 'Confirmed';
        $order->save();       

        foreach($order->orderItems as $item){
            DB::table('products')
                ->where('id', $item->product_id)
                ->decrement('quantity', $item->qty);
        }
        
        $alert = array('alertType'=>'success', 'alertMsg'=>'Order confirmed successfully!');
        return redirect()->route('orders.confirmed')->with($alert);
    }

    public function destroy($id){
        $order = Order::withoutTrashed()->findOrFail($id);
        $order->forceDelete();
        $alert = array('alertType'=>'success', 'alertMsg'=>'Order deleted successfully!');
        return redirect()->route('admin.dashboard')->with($alert);
    }

    protected function _STATUS(){
        return array('Pending', 'Processing', 'Delivered', 'Canceled');
    }

}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\TopSellingProducts;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SalesReportController extends Controller
{
    
    use TopSellingProducts;

    public function index()
    {
        return view('backend.sales.index');
    }

    public function trends(Request $request)
    {
        if($request->ajax()){
            $items = $this->getTopSellingProducts();
            $data  = DataTables::of($items)
                                ->editColumn('product_id', '#{{ $product_id}} ')
                                ->addColumn('image', function($row){
                                    $image = is_null($row->product->image) ? 'images/backend/no_image.jpg' : $row->product->image;
                                    return '<img src="'.asset($image).'" height="60" width="60">';
                                })
                                ->addColumn('name', function($row){
                                    return $row->product->title;
                                })
                                ->addColumn('code', function($row){
                                    return $row->product->code;
                                })
                                ->addColumn('present_qty', function($row){
                                    return $row->product->quantity;
                                })
                                ->addColumn('action', function($row){
                                    $view = '<a href="" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>';
                                    return $view;
                                })
                                ->rawColumns(['image', 'action'])
                                ->make(true);
            return $data;                    
        }
        return view('backend.sales.trends');
    }

    public function search(Request $request){

        $request->validate([
            'from' => 'required|date|before_or_equal:to',
            'to'   => 'required|date|after_or_equal:from'
        ],
        [
            'from.before_or_equal' => 'From Date should be before or equal to targeted to date',
            'to.after_or_equal' => 'To Date should be after or equal to targeted from date',
        ]);

        $from_date = $request->from;
        $to_date   = $request->to;

        $report = Order::with('orderItems')
                            ->whereRaw("(status='Delivered' OR (status='Confirmed' AND payment_method='online'))")
                            ->whereDate('updated_at', '>=', $from_date)
                            ->whereDate('updated_at', '<=', $to_date)
                            ->get();

        $total_earning = 0;
        if($report->isNotEmpty()){
            $total_earning = $report->sum('amount');
        }           

        if($request->ajax()){
            $data =  DataTables::of($report)
            ->editColumn('created_at', 
            'O#{{ date("d-m-Y", strtotime($created_at)) }}')
            ->editColumn('amount', 
            '৳ {{ number_format($amount) }}')
            ->addColumn('total_items', function($row){
                return $row->orderItems->count();
            })
            ->editColumn('delivered_at', function($row){
                if(is_null($row->delivered_at)){
                    return $row->status;
                }

                return 'O#'.date("d-m-Y", strtotime($row->delivered_at));
            })
            ->addColumn('action', function($row){
                $view = '<a href="'.route('orders.details', ['id'=>$row->id]).'" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>';
                return $view;
              })
            ->rawColumns(['action'])
            ->make(true);

            return $data;
        }

        return view('backend.sales.search-result', 
               compact('from_date', 'to_date', 'total_earning'));
    }

}

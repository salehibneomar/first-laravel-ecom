<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    
    public function index(Request $request)
    {
        if($request->ajax()){
            $users = User::all();
            
            $data = DataTables::of($users)
                              ->editColumn('id', 
                              '#{{ $id }}')
                              ->editColumn('image', function($row){
                                  $image = is_null($row->image) ? 'images/frontend/default_user.png' : $row->image;

                                  return '<img src="'.asset($image).'" height="50" width="50" style="border-radius:50%; ">';
                              })
                              ->editColumn('created_at', function($row){
                                  return $row->created_at->diffForHumans();
                              })
                              ->addColumn('action', function($row){
                                $view = '<a href="'.route('user.orders', ['userId'=>$row->id]).'" class="btn btn-sm btn-warning"><i class="fas fa-shopping-cart"></i></a>';
                                return $view;
                              })
                              ->rawColumns(['image', 'action'])
                              ->make(true);
            return $data;
        }
        return view('backend.user.userlist');
    }

    public function orders(Request $request, $userId){
        
        $userName = (User::select('name')->findOrFail($userId))->name;

        if($request->ajax()){
            $orders = Order::with('user')
            ->whereNull('deleted_at')
            ->where('user_id', $userId)
            ->get();

            $data = DataTables::of($orders)
                              ->editColumn('amount', 
                              '৳ {{ number_format($amount) }}')
                              ->editColumn('created_at', 
                              '{{ date("d M Y, h:i A", strtotime($created_at)) }}')
                              ->addColumn('action', function($row){
                                $view = '<a href="'.route('orders.details', ['id'=>$row->id]).'" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>';
                                return $view;
                              })
                              ->rawColumns(['action'])
                              ->make(true);
            return $data;                                 
        }

        return view('backend.user.orders', compact('userName'));
    }

}

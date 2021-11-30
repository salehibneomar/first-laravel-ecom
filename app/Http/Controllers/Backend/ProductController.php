<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $products = Product::withoutTrashed()->with(['category', 'brand'])->get();
            return DataTables::of($products)
            ->editColumn('id', '#{{ $id }}')
            ->editColumn(
                'image', '<img src="@if(is_null($image)) {{ asset("images/backend/no_image.jpg") }} @else {{ asset($image) }} @endif" width="60" height="60" title="{{ $title }}">'
            )
            ->editColumn('price', '{{ number_format($price) }}')
            ->addColumn('brand', function($row){
                return $row->brand->name;
            })
            ->addColumn('category', function($row){
                return $row->category->name;
            })
            ->editColumn('status', function($row){
                $status = '';
                switch($row->status){
                    case 0:
                        $status = 'Inactive';
                        break;
                    case 2:
                        $status = 'Discontinued';
                        break;
                    case 3:
                        $status = 'Forced stock out';
                        break;
                    default :
                        $status = 'Live';             
                }
                return $status;
            })
            ->addColumn('action', function($row){
                $edit = '<a href="'.route('product.edit', ['id'=> $row->id]).'" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>';
                $del  = '<a href="'.route('product.delete', ['id'=> $row->id]).'" class="btn btn-sm btn-danger product-delete"><i class="fas fa-trash-alt"></i></a>';

                $btns = $edit.'&nbsp;'.$del;
                return $btns;
            })
            ->rawColumns(['image', 'action'])
            ->make(true);
            
        }
        return view('backend.product.all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        $brands     = Brand::withoutTrashed()->get();
        return view('backend.product.add', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|min:3|max:250',
            'price'             => 'required|numeric',
            'discount'          => 'nullable|integer',
            'code'              => 'required',
            'quantity'          => 'required|integer',
            'condition'         => 'nullable',
            'status'            => 'nullable|integer',
            'image'             => 'nullable|min:1|max:5120|mimes:png,jpg,jpeg',
            'is_featured'       => 'nullable',
            'short_description' => 'required|max:250',
            'long_description'  => 'required|max:2500',
            'brand_id'          => 'required|integer',
            'category_id'       => 'required|integer',
        ]);

        $product = new Product();

        $product->title             = Str::title($request->title);
        $product->slug              = Str::slug($request->title);
        $product->price             = $request->price;
        $product->discount          = $request->discount;
        $product->code              = $request->code;
        $product->quantity          = $request->quantity;
        $product->condition         = $request->condition;
        $product->status            = $request->status;
        $product->is_featured       = isset($request->is_featured) ? 1 : 0;
        $product->short_description = $request->short_description;
        $product->long_description  = $request->long_description;
        $product->brand_id          = $request->brand_id;
        $product->category_id       = $request->category_id;

        if($request->hasFile('image')){
            $imageFile = $request->file('image');
            $imageNameGen = hexdec(uniqid()).'_'.date('dmYHis').'.'.$imageFile->getClientOriginalExtension();
            $imageLocation = 'images/backend/product/';
            Image::make($imageFile)->resize(917, 1000)->save($imageLocation.$imageNameGen);
            $product->image = $imageLocation.$imageNameGen;
        }

        $alert = array(
            'alertType' => 'success',
            'alertMsg'  => 'Product created successfully!',
        );

        $product->save();

        return redirect()->route('product.all')->with($alert);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product    = Product::withoutTrashed()->findOrFail($id);
        $categories = Category::whereNull('parent_id')->get();
        $brands     = Brand::withoutTrashed()->get();
        return view('backend.product.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::withoutTrashed()->findOrFail($id);

        $validated = $request->validate([
            'title'             => 'required|min:3|max:250',
            'price'             => 'required|numeric',
            'discount'          => 'nullable|integer',
            'code'              => 'required',
            'quantity'          => 'required|integer',
            'condition'         => 'nullable',
            'status'            => 'nullable|integer',
            'image'             => 'nullable|min:1|max:5120|mimes:png,jpg,jpeg',
            'is_featured'       => 'nullable',
            'short_description' => 'required|max:250',
            'long_description'  => 'required|max:2500',
            'brand_id'          => 'required|integer',
            'category_id'       => 'required|integer',
        ]);

        $product->title             = Str::title($request->title);
        $product->slug              = Str::slug($request->title);
        $product->price             = $request->price;
        $product->discount          = $request->discount;
        $product->code              = $request->code;
        $product->quantity          = $request->quantity;
        $product->condition         = $request->condition;
        $product->status            = $request->status;
        $product->is_featured       = isset($request->is_featured) ? 1 : 0;
        $product->short_description = $request->short_description;
        $product->long_description  = $request->long_description;
        $product->brand_id          = $request->brand_id;
        $product->category_id       = $request->category_id;

        if($request->hasFile('image')){
            $imageFile = $request->file('image');
            $imageNameGen = hexdec(uniqid()).'_'.date('dmYHis').'.'.$imageFile->getClientOriginalExtension();
            $imageLocation = 'images/backend/product/';
            Image::make($imageFile)->resize(917, 1000)->save($imageLocation.$imageNameGen);
            $product->image = $imageLocation.$imageNameGen;
        }

        $alert = array(
            'alertType' => 'success',
            'alertMsg'  => 'Product updated successfully!',
        );

        $product->save();

        return redirect()->route('product.all')->with($alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::withoutTrashed()->findOrFail($id);

        $alert = array(
            'alertType' => 'success',
            'alertMsg'  => 'Product deleted successfully!',
        );

        $product->delete();

        return back()->with($alert);
    }
}

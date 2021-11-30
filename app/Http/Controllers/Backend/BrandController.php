<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $brands = Brand::withoutTrashed()->get();
            return DataTables::of($brands)
            ->editColumn('id', '#'.'{{ $id }}')
            ->editColumn(
                'image', '<img src="{{ asset($image) }}" width="60" height="50" title="{{ $name }}">'
            )
            ->editColumn('created_at', '{{ date("d M Y", strtotime($created_at)) }}')
            ->addColumn('action', function($row){
                $edit = '<a href="'.route('brand.edit', ['id'=> $row->id]).'" class="btn btn-info"><i class="fas fa-edit"></i></a>';
                $del  = '<a href="'.route('brand.delete', ['id'=> $row->id]).'" class="btn btn-danger brand-delete"><i class="fas fa-trash-alt"></i></a>';

                $btns = $edit.'&ensp;'.$del;
                return $btns;
            })
            ->rawColumns(['image', 'action'])
            ->make(true);
            
        }
        return view ('backend.brand.all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.add');
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
            'name' => 'required|min:2|max:250|unique:brands,name,NULL,id,deleted_at,NULL',
            'image' => 'required|min:1|max:3072|mimes:png,jpg,jpeg',
        ]);

        $brand = new Brand();
        $brand->name = Str::ucfirst($request->name);
        $brand->slug = Str::slug($request->name);
        
        $imageFile = $request->file('image');
        $imageNameGen = rand(100000, 999999).'_'.Str::lower(Str::replace(' ', '_', $request->name)).'_'.date('mdYHis').'.'.$imageFile->getClientOriginalExtension();
        $imageLocation = 'images/backend/brand/';
    
        $brand->image = $imageLocation.$imageNameGen;

        if($brand->save()){
            Image::make($imageFile)->resize(100, 100)->save($imageLocation.$imageNameGen);
        }

        $alert = array(
            'alertType' => 'success',
            'alertMsg'  => 'Brand created successfully!',
        );

        return redirect()->route('brand.all')->with($alert);
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
        $brand = Brand::withoutTrashed()->findOrFail($id);
        return view('backend.brand.edit', compact('brand'));
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
        $brand = Brand::withoutTrashed()->findOrFail($id);
        $oldImage = $brand->image;

        $validated = $request->validate([
            'name' => 'required|min:2|max:250|unique:brands,name,'.$id.',id,deleted_at,NULL',
            'image' => 'min:1|max:3072|mimes:png,jpg,jpeg',
        ]);

        $brand->name = Str::ucfirst($request->name);
        $brand->slug = Str::slug($request->name);

        if($request->hasFile('image')){
            $imageFile = $request->file('image');
            $imageNameGen = rand(100000, 999999).'_'.Str::lower(Str::replace(' ', '_', $request->name)).'_'.date('mdYHis').'.'.$imageFile->getClientOriginalExtension();
            $imageLocation = 'images/backend/brand/';
            $brand->image = $imageLocation.$imageNameGen;
            if(file_exists($oldImage)){
                unlink($oldImage);
            }
            Image::make($imageFile)->resize(100,100)->save($imageLocation.$imageNameGen);
        }

        $brand->save();

        $alert = array(
            'alertType' => 'success',
            'alertMsg'  => 'Brand updated successfully!',
        );

        return redirect()->route('brand.all')->with($alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::withoutTrashed()->findOrFail($id);
        $brand->delete();
        $alert = array(
            'alertType' => 'success',
            'alertMsg'  => 'Brand deleted successfully!',
        );
        return back()->with($alert);
    }
}

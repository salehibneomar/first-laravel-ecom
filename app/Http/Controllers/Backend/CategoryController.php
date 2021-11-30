<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $categories = Category::all();
            return DataTables::of($categories)
            ->editColumn('id', '#'.'{{ $id }}')
            ->editColumn('status', function($row){
                $status = ($row->status) == 0 ? '<span class="badge badge-danger">Inactive</span>' : '<span class="badge badge-success">Live</span>';

                return $status;
            })
            ->addColumn('parent', function($row){
                $result = is_null($row->parent_id) ? 'Main' : $row->parent->name;
                return $result;
            })
            ->addColumn('action', function($row){
                $edit = '<a href="'.route('category.edit', ['id'=> $row->id]).'" class="btn btn-info"><i class="fas fa-edit"></i></a>';
                $del  = '<a href="'.route('category.delete', ['id'=> $row->id]).'" class="btn btn-danger category-delete"><i class="fas fa-trash-alt"></i></a>';

                $btns = $edit.'&ensp;'.$del;
                return $btns;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
            
        }
        return view('backend.category.all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = Category::where('status', 1)
                            ->where('parent_id', null)
                            ->get();
        return view('backend.category.add', compact('parentCategories'));
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
            'name' => 'required|min:2|max:250',
            'parent_id' => 'nullable',
        ]);

        $category = new Category();
        $category->name = Str::ucfirst($request->name);
        $category->slug = Str::slug($request->name);
        $category->parent_id = $request->parent_id;

        $category->save();

        
        $alert = array(
            'alertType' => 'success',
            'alertMsg'  => 'Category created successfully!',
        );

        return redirect()->route('category.all')->with($alert);
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
        $category = Category::findOrFail($id);
        $isMain = is_null($category->parent_id) ? true : false;
        $subCatHasSubCat = false;

        if(!$isMain){
            $subCatHasSubCat = count($category->subcategories)>0 ? true : $subCatHasSubCat;
        }

        $parentCategories = Category::where('parent_id', null)
                            ->get();
        return view('backend.category.edit', compact('category', 'parentCategories', 'isMain', 'subCatHasSubCat'));
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
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|min:2|max:250',
            'status' => 'required|boolean',
            'parent_id' => 'nullable', 
        ]);

        $category->name = $request->name;
        $category->status = $request->status;
        $category->parent_id = $request->parent_id;

        $category->save();

        $alert = array(
            'alertType' => 'success',
            'alertMsg'  => 'Category updated successfully!',
        );

        return redirect()->route('category.all')->with($alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::where('id', $id)->with('tree')->firstOrFail();
        
        if(is_null($category->parent_id) && count($category->tree)>0){
            $category->tree->each(function($last){
                Category::destroy($last->subcategories);
            });
        }
        
        if(count($category->tree)>0){
            $category->tree()->delete();
        }
        
        $category->delete();

        $alert = array(
            'alertType' => 'success',
            'alertMsg'  => 'Category deleted successfully!',
        );
        
        return back()->with($alert);
    }
}

@extends('backend.layout')

@section('content')

<div class="col-md-12">
    <div class="box">
        <div class="box-header">
            <h4 class="box-title">Edit Category</h4> 
        </div>
        <div class="box-body">
            <form action="{{ route('category.update', ['id'=>$category->id]) }}" method="post" class="row" >
                @csrf
                <div class="form-group @if($isMain) {{'col-md-6'}} @else {{'col-md-12'}} @endif">
                    <label>Name*</label>
                    <input type="text" class="form-control py-2" name="name" value="{{ $category->name }}">
                </div>
                <div class="form-group col-md-6">
                    <label>Status *</label>
                    <select name="status" class="form-control py-2">
                        <option value="1" @if($category->status==1) {{ 'selected' }} @endif>Live</option>
                        <option value="0" @if($category->status==0) {{ 'selected' }} @endif>Inactive</option>
                    </select>
                </div>
                @if (!$isMain)
                <div class="form-group col-md-6">
                    <label>Parent </label>
                    <select name="parent_id" class="form-control py-2">
                        <option value="" selected disabled>--Select--</option>
                        @foreach ($parentCategories as $parentCategory)
                                <option value="{{ $parentCategory->id }}" class="bg-secondary" 
                                @if($parentCategory->id==$category->parent_id) 
                                {{ 'selected' }} 
                                @endif>
                                    {{ $parentCategory->name }}
                                </option>
                            @if(!$subCatHasSubCat)    
                            @foreach ($parentCategory->subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}" 
                                @if ($subcategory->id == $category->id)
                                    {{ 'disabled' }}
                                @elseif ($subcategory->id == $category->parent_id)
                                    {{ 'selected' }}
                                @endif>
                                    {{ $subcategory->name }}
                                </option>
                            @endforeach
                            @endif
                        @endforeach
                    </select>
                </div>  
                @endif

                <div class="form-group col-md-12 text-right" style="margin-top: 25px;">
                    <button class="btn btn-info btn-rounded">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
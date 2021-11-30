@extends('backend.layout')

@section('content')

<div class="col-md-12">
    <div class="box">
        <div class="box-header">
            <h4 class="box-title">Add New Category</h4> 
        </div>
        <div class="box-body">
            <form action="{{ route('category.store') }}" method="post" class="row" >
                @csrf
                <div class="form-group col-md-6">
                    <label>Name*</label>
                    <input type="text" class="form-control py-2" name="name" value="{{ old('name') }}">
                </div>
                <div class="form-group col-md-6">
                    <label>Parent </label>
                    <select name="parent_id" class="form-control py-2">
                        <option value="" selected disabled>--Select--</option>
                        @foreach ($parentCategories as $parentCategory)
                                <option value="{{ $parentCategory->id }}" class="bg-secondary">{{ $parentCategory->name }}</option>
                            @foreach ($parentCategory->subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}" >{{ $subcategory->name }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-12 text-right" style="margin-top: 25px;">
                    <button class="btn btn-info btn-rounded">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
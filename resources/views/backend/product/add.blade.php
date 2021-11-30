@extends('backend.layout')

@section('content')

<div class="col-md-12">
    <div class="box">
        <div class="box-header">
            <h4 class="box-title">Add New Product</h4> 
        </div>
        <div class="box-body">
            <form action="{{ route('product.store') }}" method="post" class="row" enctype="multipart/form-data">
                @csrf
                <div class="form-group col-md-12">
                    <label>Title *</label>
                    <input type="text" class="form-control py-2" name="title" value="{{ old('title') }}">
                </div>
                <div class="form-group col-md-3">
                    <label>Price *</label>
                    <input type="number" class="form-control py-2" name="price" value="{{ old('price') }}">
                </div>
                <div class="form-group col-md-3">
                    <label>Discount</label>
                    <input type="number" class="form-control py-2" name="discount" value="{{ old('discount') }}">
                </div>

                <div class="form-group col-md-3">
                    <label>Category *</label>
                    <select name="category_id" id="" class="form-control py-2">
                        <option value="" selected disabled>--select--</option>
                        @foreach ($categories as $main)
                            <option value="{{ $main->id }}" class="bg-secondary">{{ $main->name }}</option>
                            @foreach ($main->subcategories as $sub)
                                <option value="{{ $sub->id }}">&emsp;{{ $sub->name }}</option>
                                @foreach ($sub->subcategories as $subsub)
                                    <option value="{{ $subsub->id }}">&emsp;&emsp;{{ $subsub->name }}</option>
                                @endforeach
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label>Brand *</label>
                    <select name="brand_id" id="" class="form-control py-2">
                        <option value="" selected disabled{{ old('_description') }}>--select--</option>
                        @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group col-md-3">
                    <label>Product Code *</label>
                    <input type="text" class="form-control py-2" name="code" value="{{ old('code') }}">
                </div>
                <div class="form-group col-md-3">
                    <label>Quantity *</label>
                    <input type="number" class="form-control py-2" name="quantity" value="{{ old('quantity') }}">
                </div>
                <div class="form-group col-md-3">
                    <label>Condition/Type</label>
                    <select name="condition" id="" class="form-control py-2">
                        <option value="normal">Normal</option>
                        <option value="new">New</option>
                        <option value="sale">Sale</option>
                        <option value="hot">Hot</option>

                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Status</label>
                    <select name="status" id="" class="form-control py-2">
                        <option value="1">Live</option>
                        <option value="0">Inactive</option>
                        <option value="2">Discontinued</option>
                        <option value="3">Force stock out</option>
                    </select>
                </div>
                <div class="form-group col-md-12 my-3">
                    <img src="{{ asset('images/backend/no_image.jpg') }}" alt="" width="100" height="100" id="product-image-show">
                </div>
                <div class="form-group col-md-12">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" id="product-image">
                </div>
                <div class="form-group col-md-12 mt-5">
                    <label class="mt-5">Feature Status</label>
                    <div class="demo-checkbox mt-5">
						<input type="checkbox" id="md_checkbox_21" class="filled-in chk-col-primary" name="is_featured">
						<label for="md_checkbox_21">Featured ?</label>				
					</div>
                </div>
                <div class="form-group col-md-6">
                    <label>Short Description *</label>
                    <textarea name="short_description" class="form-control" rows="5">{{ old('short_description') }}</textarea>
                </div>
                <div class="form-group col-md-6">
                    <label>Long Description *</label>
                    <textarea name="long_description" class="form-control" rows="5">{{ old('long_description') }}</textarea>
                </div>
                
                <div class="form-group col-md-12 text-right" style="margin-top: 25px;">
                    <button class="btn btn-info btn-rounded">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('extraScripts')

    <script>
        $('#product-image').change(function(e){
            let reader    = new FileReader();
            reader.onload = function(e){
                $('#product-image-show').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    </script>

@endsection
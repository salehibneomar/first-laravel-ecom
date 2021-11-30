@extends('backend.layout')

@section('content')

<div class="col-md-12">
    <div class="box">
        <div class="box-header">
            <h4 class="box-title">Edit Product</h4> 
        </div>
        <div class="box-body">
            <form action="{{ route('product.update', ['id'=>$product->id]) }}" method="post" class="row" enctype="multipart/form-data">
                @csrf
                <div class="form-group col-md-12">
                    <label>Title *</label>
                    <input type="text" class="form-control py-2" name="title" value="{{ $product->title }}">
                </div>
                <div class="form-group col-md-3">
                    <label>Price *</label>
                    <input type="number" class="form-control py-2" name="price" value="{{ $product->price }}">
                </div>
                <div class="form-group col-md-3">
                    <label>Discount</label>
                    <input type="number" class="form-control py-2" name="discount" value="{{ $product->discount }}">
                </div>

                <div class="form-group col-md-3">
                    <label>Category *</label>
                    <select name="category_id" id="" class="form-control py-2">
                        @foreach ($categories as $main)
                            <option value="{{ $main->id }}" class="bg-secondary"
                                @if ($main->id==$product->category_id)
                                    {{ 'selected' }}
                                @endif
                                >{{ $main->name }}</option>
                            @foreach ($main->subcategories as $sub)
                                <option value="{{ $sub->id }}"
                                    @if ($sub->id==$product->category_id)
                                    {{ 'selected' }}
                                    @endif
                                    >&emsp;{{ $sub->name }}</option>
                                @foreach ($sub->subcategories as $subsub)
                                    <option value="{{ $subsub->id }}"
                                        @if ($subsub->id==$product->category_id)
                                        {{ 'selected' }}
                                        @endif
                                        >&emsp;&emsp;{{ $subsub->name }}</option>
                                @endforeach
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label>Brand *</label>
                    <select name="brand_id" id="" class="form-control py-2">
                        @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" @if ($brand->id==$product->brand_id)
                            {{ 'selected' }}
                        @endif >{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group col-md-3">
                    <label>Product Code *</label>
                    <input type="text" class="form-control py-2" name="code" value="{{ $product->code }}">
                </div>
                <div class="form-group col-md-3">
                    <label>Quantity *</label>
                    <input type="number" class="form-control py-2" name="quantity" value="{{ $product->quantity }}">
                </div>
                <div class="form-group col-md-3">
                    <label>Condition/Type</label>
                    <select name="condition" id="" class="form-control py-2">
                        @php
                            $condition = array(
                                'normal' => 'Normal',
                                'new'    => 'New',
                                'sale'   => 'Sale',
                                'hot'    => 'Hot',
                            );
                        @endphp
                        @foreach ($condition as $key => $val )
                        <option value="{{ $key }}" @if ($key==$product->condition)
                            {{ 'selected' }}
                        @endif >{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Status</label>
                    <select name="status" id="" class="form-control py-2">
                        @php
                            $status = array('Inactive', 'Live', 'Discontinued', 'Force stock out');
                        @endphp
                        @foreach ($status as $key => $val )
                            <option value="{{ $key }}" @if ($key==$product->status)
                                {{ 'selected' }}
                            @endif >{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-12 my-3">
                    @if(is_null($product->image))
                    <img src="{{ asset('images/backend/no_image.jpg') }}" alt="" width="100" height="100" id="product-image-show">
                    @else
                    <img src="{{ asset($product->image) }}" alt="" width="100" height="100" id="product-image-show">
                    @endif
                </div>
                <div class="form-group col-md-12">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" id="product-image">
                </div>
                <div class="form-group col-md-12 mt-5">
                    <label class="mt-5">Feature Status</label>
                    <div class="demo-checkbox mt-5">
						<input type="checkbox" id="md_checkbox_21" class="filled-in chk-col-primary" name="is_featured"
                        @if ($product->is_featured==1)
                            {{ 'checked' }}
                        @endif
                        >
						<label for="md_checkbox_21">Featured ?</label>				
					</div>
                </div>
                <div class="form-group col-md-6">
                    <label>Short Description *</label>
                    <textarea name="short_description" class="form-control" rows="5">{{ $product->short_description }}</textarea>
                </div>
                <div class="form-group col-md-6">
                    <label>Long Description *</label>
                    <textarea name="long_description" class="form-control" rows="5">{{ $product->long_description }}</textarea>
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
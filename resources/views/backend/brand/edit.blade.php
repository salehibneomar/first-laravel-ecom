@extends('backend.layout')

@section('content')

<div class="col-md-12">
    <div class="box">
        <div class="box-header">
            <h4 class="box-title">Edit Brand</h4> 
        </div>
        <div class="box-body">
            <form action="{{ route('brand.update', ['id'=> $brand->id]) }}" method="post" class="row" enctype="multipart/form-data">
                @csrf
                  <div class="form-group col-md-6">
                    <label>Name*</label>
                    <input type="text" class="form-control py-2" name="name" value="{{ $brand->name }}">
                </div>
                <div class="form-group col-md-6">
                    <label>Image *</label>
                    <input type="file" class="form-control py-2" name="image" >
                </div>
                <div class="form-group col-md-12 text-right" style="margin-top: 25px;">
                    <button class="btn btn-info btn-rounded">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
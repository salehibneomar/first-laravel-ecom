@extends('backend.layout')

@section('content')

<div class="col-md-12">
    <div class="box">
        <div class="box-header">
            <h4 class="box-title">Edit Banner Slider</h4> 
        </div>
        <div class="box-body">
            <form action="{{ route('banner.slider.update', ['id'=>$bannerSlider->id]) }}" method="post" class="row" enctype="multipart/form-data">
                @csrf
                <div class="form-group col-md-12">
                    <label>Normal Title *</label>
                    <input type="text" class="form-control py-2" name="normal_title" value="{{ $bannerSlider->normal_title }}">
                </div>
                <div class="form-group col-md-6">
                    <label>Colored Title</label>
                    <input type="text" class="form-control py-2" name="colored_title" value="{{ $bannerSlider->colored_title }}">
                </div>
                <div class="form-group col-md-6">
                    <label>Short Note</label>
                    <input type="text" class="form-control py-2" name="short_note" value="{{ $bannerSlider->short_note }}">
                </div>
                <div class="form-group col-md-8">
                    <label>Image *</label>
                    <input type="file" class="form-control py-2" name="image" >
                </div>
                <div class="form-group col-md-4 py-2">
                    <label>Status *</label>
                    <select class="form-control" name="status">
                        <option value="0" @if ($bannerSlider->status==0)
                            {{ 'selected' }}
                        @endif >Inactive</option>
                        <option value="1" @if ($bannerSlider->status==1)
                            {{ 'selected' }}
                        @endif >Live</option>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label>Short Description </label>
                    <textarea name="short_description" class="form-control" rows="5">{{ $bannerSlider->short_description }}</textarea>
                </div>
                
                <div class="form-group col-md-12 text-right" style="margin-top: 25px;">
                    <button class="btn btn-info btn-rounded">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
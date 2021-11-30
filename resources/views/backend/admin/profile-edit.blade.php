@extends('backend.layout')

@section('content')

    <div class="col-md-4">
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">Picture</h4> 
            </div>
            <div class="box-body">
                <form action="{{ route('admin.profile.update.image') }}" method="post" class="row" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <img
                        src="@if ( !is_null(Auth::guard('admin')->user()->image) && !empty(Auth::guard('admin')->user()->image)) 
                            {{ asset(Auth::guard('admin')->user()->image) }}
                        @else
                            {{ asset('images/backend/default-user-avatar.png') }}
                        @endif" class="px-4 py-2" style="min-width: 130px; max-width:130px; min-height:100px; max-height:100px; border-radius: 50%" id="admin-image-show">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Image</label>
                        <input type="file" class="form-control py-2" id="admin-image" name="image">
                    </div>
                    <div class="form-group col-md-12 text-right" style="margin-top: 25px;">
                        <button class="btn btn-info btn-rounded">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">General</h4> 
            </div>
            <div class="box-body">
                <form action="{{ route('admin.profile.update.general') }}" method="post" class="row">
                    @csrf
                    <div class="form-group col-md-12">
                        <label>Full Name *</label>
                        <input type="text" class="form-control py-2" name="name" value="{{ Auth::guard('admin')->user()->name }}">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Email *</label>
                        <input type="email" class="form-control py-2" name="email" value="{{ Auth::guard('admin')->user()->email }}">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Phone</label>
                        <input type="tel" class="form-control py-2" name="phone" value="{{ Auth::guard('admin')->user()->phone }}">
                    </div>
                    <div class="form-group col-md-12 text-right" style="margin-top: 25px;">
                        <button class="btn btn-info btn-rounded">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">Password</h4> 
            </div>
            <div class="box-body">
                <form action="{{ route('admin.profile.update.password') }}" method="post" class="row">
                    @csrf
                    <div class="form-group col-md-12">
                        <label>Current Password *</label>
                        <input type="password" class="form-control py-2" name="old_password">
                    </div>
                    <div class="form-group col-md-12">
                        <label>New Password *</label>
                        <input type="password" class="form-control py-2" name="new_password">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Retype Password *</label>
                        <input type="password" class="form-control py-2" name="new_password_confirmation">
                    </div>
                    <div class="form-group col-md-12 text-right" style="margin-top: 25px;">
                        <button class="btn btn-info btn-rounded">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('extraScripts')

    <script>
        $('#admin-image').change(function(e){
            let reader    = new FileReader();
            reader.onload = function(e){
                $('#admin-image-show').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    </script>

@endsection
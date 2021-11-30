@extends('frontend.layout')

@section('pageTitle')
{{ 'Edit Profile' }}
@endsection

@section('content')

<div class="row" style="padding: 0px 30px !important;">
    <div class="sign-in-page col-md-8 col-md-offset-2" style="margin-bottom: 30px !important;">
        <div class="row">
        
            <div class="col-md-12 sign-in">
                <h4 class="">Update Profile Picture</h4>
                <form class="register-form outer-top-xs" role="form" method="POST" action="{{ route('account.update.image') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <img 
                        src="@if (is_null($user->image) || empty($user->image))
                            {{ asset('images/frontend/default_user.png') }}
                        @else
                        {{ asset($user->image) }}  
                        @endif" 
                        style="min-width: 100px; max-width:100px; min-height:100px; max-height:100px; border-radius:50%; " id="user-image-show">
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="user-image">Image<span>*</span></label>
                        <input type="file" class="form-control unicase-form-control text-input" id="user-image" name="image" >

                        @error('image')
                        <br>
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Update</button>
                </form>					
            </div>
    
        </div>	
    </div>
</div>

<div class="row" style="padding: 0px 30px !important;">
    <div class="sign-in-page col-md-8 col-md-offset-2" style="margin-bottom: 30px !important;">
        <div class="row">
        
            <div class="col-md-12 sign-in">
                <h4 class="">Update Profile Information</h4>
                <form class="register-form outer-top-xs" role="form" method="POST" action="{{ route('account.update.information') }}">
                    @csrf

                    <div class="form-group">
                        <label class="info-title" >Full Name <span>*</span></label>
                        <input type="text" class="form-control unicase-form-control text-input"  name="name" value="{{ $user->name }}" >

                        @error('name')
                        <br>
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label class="info-title" >Email Address <span>*</span></label>
                        <input type="email" class="form-control unicase-form-control text-input"  name="email"  value="{{ $user->email }}" >

                        @error('email')
                        <br>
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label class="info-title" >Phone Number</label>
                        <input type="tel" class="form-control unicase-form-control text-input"  name="phone"  value="{{ $user->phone }}" >

                        @error('phone')
                        <br>
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    
                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Update</button>
                </form>					
            </div>
    
        </div>	
    </div>
</div>

@endsection

@section('custom_scripts')

    <script>
        $('#user-image').change(function(e){
            let reader    = new FileReader();
            reader.onload = function(e){
                $('#user-image-show').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    </script>

@endsection
@extends('frontend.layout')

@section('pageTitle')
{{ 'Register' }}
@endsection

@section('content')

<div class="row" style="padding: 0px 30px !important;">
    <div class="sign-in-page col-md-6 col-md-offset-3" style="margin-bottom: 30px !important;">
        <div class="row">
        
            <div class="col-md-12 create-new-account">
                <h4 class="checkout-subtitle">Create a new account</h4>
                <p class="text title-tag-line">Create your new account.</p>
                <form class="register-form outer-top-xs" role="form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
                        <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail2" name="email" value="{{ old('email') }}">
                        @error('email')
                        <br>
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
                        <input type="text" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="name" value="{{ old('name') }}">
                        @error('name')
                        <br>
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Password <span>*</span></label>
                        <input type="password" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="password">
                        @error('password')
                        <br>
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
                        <input type="password" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="password_confirmation">
                    </div>
                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
                </form>
            </div>	
    
        </div>	
    </div>
</div>

@endsection

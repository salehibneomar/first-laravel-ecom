@extends('frontend.layout')

@section('pageTitle')
{{ 'Edit Password' }}
@endsection

@section('content')

<div class="row" style="padding: 0px 30px !important;">
    <div class="sign-in-page col-md-8 col-md-offset-2" style="margin-bottom: 30px !important;">
        <div class="row">
        
            <div class="col-md-12 sign-in">
                <h4 class="">Update Password</h4>
                <form class="register-form outer-top-xs" role="form" method="POST" action="{{ route('account.update.password') }}" >
                    @csrf

                    <div class="form-group">
                        <label class="info-title" >Current Password <span>*</span></label>
                        <input type="password" class="form-control unicase-form-control text-input"  name="current_password" >

                        @error('current_password')
                        <br>
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label class="info-title" >New Password <span>*</span></label>
                        <input type="password" class="form-control unicase-form-control text-input"  name="new_password" >

                        @error('new_password')
                        <br>
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="info-title" >Retype Password <span>*</span></label>
                        <input type="password" class="form-control unicase-form-control text-input"  name="new_password_confirmation" >
                    </div>

                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Update</button>
                </form>					
            </div>
    
        </div>	
    </div>
</div>

@endsection

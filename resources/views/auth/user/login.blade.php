@extends('frontend.layout')

@section('pageTitle')
{{ 'Login' }}
@endsection

@section('content')

<div class="row" style="padding: 0px 30px !important;">
    <div class="sign-in-page col-md-6 col-md-offset-3" style="margin-bottom: 30px !important;">
        <div class="row">
        
            <div class="col-md-12 sign-in">
                <h4 class="">Sign in</h4>
                <form class="register-form outer-top-xs" role="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                        <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="email" value="{{ old('email') }}" required>

                        @error('email')
                        <br>
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                        <input type="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1" name="password" required>

                        @error('password')
                        <br>
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="radio outer-xs">
                        <label>
                            <input type="radio" name="remember" id="optionsRadios2" value="option2">Remember me!
                        </label>
                        @if (Route::has('password.request'))
                        <a href="#" class="forgot-password pull-right">Forgot your Password?</a>
                        @endif
                    </div>
                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
                </form>					
            </div>
    
        </div>	
    </div>
</div>

@endsection
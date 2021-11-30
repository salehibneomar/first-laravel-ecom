@extends('auth.admin.layout')

@section('content')
    
    <form method="post" action="{{ route('admin.login') }}">
        @csrf
        <div class="form-group">
            <input type="email" class="form-control form-control-dark" placeholder="Enter your email" name="email" value="{{ old('email') }}"  autocomplete="email" style="border-radius: 10px !important;">
        </div>

        <div class="form-group mg-b-35">
            <input type="password" class="form-control form-control-dark" placeholder="Enter your password" name="password"  style="border-radius: 10px !important;">
        </div>

        <div class="form-group mg-b-35 px-1">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} >
                <label class="form-check-label" for="remember">
                      Remember Me
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-info btn-block" style="background-color: #723cf0 !important; border-color: #6424F7 !important; border-radius: 10px !important;"><i class="fas fa-sign-in-alt"></i>&ensp;Login</button>
    </form>

@endsection
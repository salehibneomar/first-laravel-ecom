@extends('frontend.layout')

@section('pageTitle')
{{ 'Profile' }}
@endsection

@section('content')

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="my-wishlist-page" style="margin-bottom: 30px !important;">
            <div class="row">
                <div class="col-md-12 my-wishlist">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="4" class="heading-title">My Account</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="profile-tr">
                                    <td class="text-center" colspan="2">
                                        <img 
                                        src="@if (is_null($user->image) || empty($user->image))
                                            {{ asset('images/frontend/default_user.png') }}
                                        @else
                                        {{ asset($user->image) }}  
                                        @endif" 
                                        style="min-width: 120px; max-width:120px; min-height:120px; max-height:120px; border-radius:50%; ">
                                    </td>
                                </tr>
                                <tr class="profile-tr">
                                    <th>Name</th>
                                    <td class="text-right">{{ $user->name; }}</td>
                                </tr>
                                <tr class="profile-tr">
                                    <th>Email</th>
                                    <td class="text-right">{{ $user->email }}</td>
                                </tr>
                                <tr class="profile-tr">
                                    <th>Phone</th>
                                    <td class="text-right">
                                        @if (!is_null($user->phone))
                                            {{ $user->phone }}
                                        @else
                                        N/A    
                                        @endif
                                    </td>
                                </tr>
                                <tr class="profile-tr">
                                    <th>Joined</th>
                                    <td class="text-right">{{ date('d M Y', strtotime($user->created_at)) }}</td>
                                </tr>
                                <tr class="profile-tr">
                                    <td class="text-center" colspan="2">
                                        <a href="{{ route('account.edit.profile') }}" class="btn btn-primary" style="border-radius: 0% !important;">Edit Profile</a>
                                        <a href="{{ route('account.orders') }}" class="btn btn-warning" style="border-radius: 0% !important;">My Orders</a>
                                        <a href="{{ route('account.edit.password') }}" class="btn btn-info" style="border-radius: 0% !important;">Edit Password</a>
                                        <a href="{{ route('logout') }}" class="btn btn-danger" style="border-radius: 0% !important;" onclick="event.preventDefault();document.getElementById('logout-btn').submit();">Logout</a>
                                        <form action="{{ route('logout') }}" method="post" id='logout-btn'>
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>			
            </div>
        </div>
    </div>
</div>

@endsection
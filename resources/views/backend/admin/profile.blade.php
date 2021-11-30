@extends('backend.layout')

@section('content')

<div class="box box-widget widget-user mt-5">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-black" style="min-height: 160px; max-height: 160px;">
        <a href="{{ route('admin.profile.edit') }}" class="btn btn-info btn-success btn-rounded float-right"><i class="fa fa-edit"></i>&ensp;Edit</a>
      <h3 class="widget-user-username">
          {{ Auth::guard('admin')->user()->name }}
      </h3>
      <h6 class="widget-user-desc">Admin</h6>
    </div>
    <div class="widget-user-image">
      <img class="rounded-circle" 
      src="@if ( !is_null(Auth::guard('admin')->user()->image) && !empty(Auth::guard('admin')->user()->image)) 
          {{ asset(Auth::guard('admin')->user()->image) }}
      @else
      {{ asset('images/backend/default-user-avatar.png') }}
      @endif" >
    </div>
    <div class="box-footer">
      <div class="row">
        <div class="col-sm-4">
          <div class="description-block">
            <h5 class="description-header">Email</h5>
            <span class="description-text">{{ Auth::guard('admin')->user()->email }}</span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4 br-1 bl-1">
          <div class="description-block">
            <h5 class="description-header">Phone</h5>
            <span class="description-text">
                @if(is_null(Auth::guard('admin')->user()->phone))
                N/A 
                @else
                {{ Auth::guard('admin')->user()->phone }}
                @endif
            </span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4">
          <div class="description-block">
            <h5 class="description-header">Joined</h5>
            <span class="description-text">
                {{ Auth::guard('admin')->user()->created_at->diffForHumans() }}
            </span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
  </div>

@endsection

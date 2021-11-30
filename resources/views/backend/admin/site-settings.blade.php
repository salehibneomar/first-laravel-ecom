@extends('backend.layout')

@section('content')

<div class="col-6">
    <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title">Site Information</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <ul class="list-group">
                <li class="list-group-item"><strong>Name: <br></strong>{{ $settings->name }}</li>
                <li class="list-group-item"><strong>Email: <br></strong>{{ $settings->email }}</li>
                <li class="list-group-item"><strong>Phone: <br></strong>{{ $settings->phone }}</li>
                <li class="list-group-item"><strong>Address: <br></strong>{{ $settings->address }}</li>
                <li class="list-group-item"><strong>Logo: <br><br> </strong>
                    <img src="{{ asset($settings->logo) }}" width="140" height="36"><br><br>
                </li>
                <li class="list-group-item"><strong>Tab Icon: <br><br> </strong>
                    <img src="{{ asset($settings->tab_icon) }}" width="25" height="25"><br><br>
                </li>
            </ul>
        </div>
        <!-- /.box-body -->
    </div>

</div>

<div class="col-6">

    <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title">Update Information</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <form action="{{ route('site.settings.update') }}" method="post" enctype="multipart/form-data">
                 @csrf
                <div class="form-group">
                     <label >Name</label>
                     <input type="text" name="name"  class="form-control py-2" value="{{ $settings->name }}">
                </div>
                <div class="form-group">
                    <label >Email</label>
                    <input type="email" name="email"  class="form-control py-2" value="{{ $settings->email }}">
                </div>
                <div class="form-group">
                    <label >Phone</label>
                    <input type="tel" name="phone"  class="form-control py-2" value="{{ $settings->phone }}">
                </div>
                <div class="form-group">
                    <label >Logo</label>
                    <input type="file" name="logo"  class="form-control py-2">
                </div>
                <div class="form-group">
                    <label >Tab Icon</label>
                    <input type="file" name="tab_icon"  class="form-control py-2">
                </div>
                <div class="form-group">
                    <label >Address</label>
                    <textarea name="address" class="form-control">{{ $settings->address }}</textarea>
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-info btn-rounded">Save</button>
                </div>
             </form>
        </div>
        <!-- /.box-body -->
    </div>

</div>

@endsection

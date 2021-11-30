@extends('backend.layout')

@section('content')

<div class="col-md-7">
    <div class="box">
        <div class="box-header">
            <h4 class="box-title">Add Division</h4> 
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th style="width: 10%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($divisions as $division)
                        <tr>
                            <td>{{ $division->name }}</td>
                            <td>
                                <a href="{{ route('shipping.division.delete', ['id'=> $division->id]) }}" class="btn btn-sm btn-danger product-delete">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-md-5">
    <div class="box">
        <div class="box-header">
            <h4 class="box-title">Add Division</h4>
        </div>
        <div class="box-body">
            <form action="{{ route('shipping.division.add') }}" method="post">
                @csrf
                <div class="form-group">
                    <label >Name *</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group text-right">
                    <button class="btn btn-info btn-rounded">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
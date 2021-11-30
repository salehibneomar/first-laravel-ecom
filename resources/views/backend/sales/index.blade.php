@extends('backend.layout')

@section('content')

<div class="col-md-12">
    <div class="box">
        <div class="box-header">
            <h4 class="box-title">Sales Report Search</h4> 
        </div>
        <div class="box-body">
            
            <form action="{{ route('sales.search') }}" method="get" class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>From Date</label>
                    <input type="date" name="from" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>To Date</label>
                    <input type="date" name="to" class="form-control">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group text-right">
                  <button type="submit" class="btn btn-info btn-rounded">Search</button>
                </div>
              </div>
            </form>
            
        </div>
    </div>
</div>

@endsection
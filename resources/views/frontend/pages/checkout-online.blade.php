@extends('frontend.layout')

@section('pageTitle')
  {{ 'Checkout' }}
@endsection

@section('content')

<div class="checkout-box ">
  <div class="row">
    <div class="col-md-12">
      <div class="panel-group checkout-steps" id="accordion">
        <!-- checkout-step-01  -->
<div class="panel panel-default checkout-step-01">

<!-- panel-heading -->
<div class="panel-heading">
  <h4 class="unicase-checkout-title">
      <a data-toggle="collapse" class="" data-parent="#accordion" href="#">
        <span><i class="fa fa-truck" aria-hidden="true"></i></span>
        Order Information
      </a>
   </h4>
</div>
<!-- panel-heading -->

<div id="" class="" style="">

<!-- panel-body  -->
  <div class="panel-body">
  <div class="row">		
    <form class="register-form" method="POST" action="{{ url('/pay') }}">
    @csrf
    <div class="col-md-6 col-sm-6">
      
        <div class="form-group">
          <label class="info-title" >Name <span>*</span></label>
          <input type="text" name="name" class="form-control unicase-form-control text-input" >
        </div>
        <div class="form-group">
          <label class="info-title">Phone <span>*</span></label>
          <input type="tel" name="phone" class="form-control unicase-form-control text-input">
        </div>
        <div class="form-group">
          <label class="info-title">Email <span>*</span></label>
          <input type="email" name="email" class="form-control unicase-form-control text-input">
        </div>

    </div>

    <div class="col-md-6 col-sm-6">
      
      <div class="form-group">
        <label class="info-title" for="exampleInputEmail1">City <span>*</span></label>
        <select name="city" class="form-control unicase-form-control" id="">
          @foreach ($divisions as $division)
            <option value="{{ $division->name }}">{{ $division->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label class="info-title">Address <span>*</span></label>
        <textarea class="form-control" name="address" rows="6"></textarea>
      </div>

      <button type="submit" class="btn-upper btn btn-primary checkout-page-button">
        Submit order
      </button>

    </div>	
  </form>	

  </div>			
</div>
<!-- panel-body  -->

</div><!-- row -->
</div>
<!-- checkout-step-01  -->

          
      </div><!-- /.checkout-steps -->
    </div>

  </div><!-- /.row -->
</div>

@endsection

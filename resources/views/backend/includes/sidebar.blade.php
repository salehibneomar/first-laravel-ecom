<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
			<div class="ulogo">
				 <a href="{{ route('admin.dashboard') }}">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">					 	
						  <img src="{{ asset($siteSettings->logo) }}" width="140" height="36">
						  
					 </div>
				</a>
			</div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">  
		  
		    <li class="@if(\Request::is('admin/dashboard')) {{ 'active' }} @endif">
          <a href="{{ route('admin.dashboard') }}">
            <i data-feather="pie-chart"></i>
			        <span>Dashboard</span>
          </a>
        </li>  
		
        <li class="treeview @if(\Request::is('brand*')) {{ 'active' }} @endif">
          <a href="#">
            <i class="fas fa-box"></i>
            <span>Brand</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('brand.all') }}"><i class="ti-more"></i>All</a></li>
            <li><a href="{{ route('brand.add') }}"><i class="ti-more"></i>Add New</a></li>
          </ul>
        </li> 

        <li class="treeview @if(\Request::is('category*')) {{ 'active' }} @endif">
          <a href="#">
            <i class="fas fa-stream"></i>
            <span>Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('category.all') }}"><i class="ti-more"></i>All</a></li>
            <li><a href="{{ route('category.add') }}"><i class="ti-more"></i>Add New</a></li>
          </ul>
        </li> 

        <li class="treeview @if(\Request::is('product*')) {{ 'active' }} @endif">
          <a href="#">
            <i class="fas fa-store"></i>
            <span>Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('product.all') }}"><i class="ti-more"></i>All</a></li>
            <li><a href="{{ route('product.add') }}"><i class="ti-more"></i>Add New</a></li>
          </ul>
        </li> 

        <li class="treeview @if(\Request::is('banner-slider*')) {{ 'active' }} @endif">
          <a href="#">
            <i class="fas fa-image"></i>
            <span>Banner Slider</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('banner.slider.all') }}"><i class="ti-more"></i>All</a></li>
            <li><a href="{{ route('banner.slider.add') }}"><i class="ti-more"></i>Add New</a></li>
          </ul>
        </li> 

        <li class="treeview @if(\Request::is('orders*')) {{ 'active' }} @endif">
          <a href="#">
            <i class="fas fa-shopping-cart"></i>
            <span>Orders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('orders.confirmed') }}"><i class="ti-more"></i>Confirmed</a></li>
            <li><a href="{{ route('orders.processing') }}"><i class="ti-more"></i>Processing</a></li>
            <li><a href="{{ route('orders.pending') }}"><i class="ti-more"></i>Pending</a></li>
            <li><a href="{{ route('orders.delivered') }}"><i class="ti-more"></i>Delivered</a></li>
            <li><a href="{{ route('orders.canceled') }}"><i class="ti-more"></i>Canceled</a></li>
          </ul>
        </li>

        <li class="treeview @if(\Request::is('shipping*')) {{ 'active' }} @endif">
          <a href="#">
            <i class="fas fa-shipping-fast"></i>
            <span>Shipping</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('shipping.division.view') }}"><i class="ti-more"></i>Division</a></li>
          </ul>
        </li>

        <li class="treeview @if(\Request::is('user*')) {{ 'active' }} @endif">
          <a href="#">
            <i class="fas fa-users"></i>
            <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('user.all') }}"><i class="ti-more"></i>All</a></li>
          </ul>
        </li>

        <li class="treeview @if(\Request::is('sales*')) {{ 'active' }} @endif">
          <a href="#">
            <i class="fas fa-chart-bar"></i>
            <span>Sale Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('sales.page') }}"><i class="ti-more"></i>Search</a></li>
            <li><a href="{{ route('sales.trends') }}"><i class="ti-more"></i>Product Trends</a></li>
          </ul>
        </li>
		  
        	  
      </ul>
    </section>
	
	
  </aside>
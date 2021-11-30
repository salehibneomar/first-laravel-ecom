<header class="main-header">
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top pl-30">
      <!-- Sidebar toggle button-->
	  <div>
		  <ul class="nav">
			<li class="btn-group nav-item">
				<a href="#" class="waves-effect waves-light nav-link rounded svg-bt-icon" data-toggle="push-menu" role="button">
					<i class="nav-link-icon mdi mdi-menu"></i>
			    </a>
			</li>

		  </ul>
	  </div>
		
      <div class="navbar-custom-menu r-side">
        <ul class="nav navbar-nav">

	      <!-- User Account-->
          <li class="dropdown user user-menu">	
			<a href="#" class="waves-effect waves-light rounded dropdown-toggle p-0" data-toggle="dropdown" title="User">
				<img src="@if ( !is_null(Auth::guard('admin')->user()->image) && !empty(Auth::guard('admin')->user()->image)) 
				{{ asset(Auth::guard('admin')->user()->image) }}
			@else
			{{ asset('images/backend/default-user-avatar.png') }}
			@endif" >
			</a>
			<ul class="dropdown-menu animated flipInX">
			  <li class="user-body">
				 <a class="dropdown-item" href="{{ route('admin.profile.show') }}"><i class="ti-user text-muted mr-2"></i> Profile</a>
				 <a class="dropdown-item" href="{{ route('site.settings.view') }}"><i class="ti-settings text-muted mr-2"></i> Settings</a>
				 <div class="dropdown-divider"></div>
				 <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
				 document.getElementById('logout-form').submit();">
				 <i class="ti-lock text-muted mr-2"></i> Logout
				</a>
				 <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
					@csrf
				</form>
			  </li>
			</ul>
          </li>	

		
        </ul>
      </div>
    </nav>
  </header>
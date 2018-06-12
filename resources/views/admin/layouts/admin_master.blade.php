<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Admin Home</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'
	/>
	<!--     Fonts and icons     -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
	<!-- CSS Files -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
	<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="{{ asset('css/light-bootstrap-dashboard.css') }}" rel="stylesheet" />
	<link href="{{ asset('css/adminCustom.css') }}" rel="stylesheet" />
	<script src="{{ asset('js/sweetalert2/sweetalert2.min.js') }}"></script>
	<link href="{{ asset('js/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">

@section('head_links')
@show

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<!-- <link href="../assets/css/demo.css" rel="stylesheet" /> -->
	<style>
		body {
			overflow: hidden;
		}
		</style>
</head>

<body    >
		@include('alert::message')
	<div class="wrapper">
		<div class="sidebar" data-image="{{ asset('img/sidebar-4.jpg')}}" data-color="blue">

			<div class="sidebar-wrapper">
				<div class="logo">
					<a href="#" class="simple-text">
						@if(Auth::user()->id==1)
						cougar
						@endif
						@if(Auth::user()->id==2)
						forecast
						@endif
						@if(Auth::user()->id>2)
						charcoal
						@endif
					</a>
				</div>
				<ul class="nav">
					<li class="nav-item @yield('active-main') ">
					<a class="nav-link" href="{{ url('admin/') }}">
							<i class="nc-icon nc-chart-pie-35"></i>
							<p>Dashboard</p>
						</a>
					</li>
					<li class="nav-item @yield('active-cat_brand')">
					<a class="nav-link" href="{{ url('admin/categories') }}">
							<i class="nc-icon nc-tag-content"></i>
							<p>Categories</p>
						</a>
					</li>
							<li class="nav-item @yield('active-product') " >
								<a class="nav-link" href="{{ url('admin/products') }}">
									<i class="nc-icon nc-layers-3"></i>
									<p>Products</p>
								</a>
							</li>

<li class="nav-item @yield('active-sales') ">
            <a class="nav-link"  href="{{ url('admin/pos/sales') }}">
              <i class="nc-icon nc-cart-simple"></i>
              <p>Sales</p>
            </a>
		  </li>
		  
		  <li class="nav-item @yield('active-bills') ">
            <a class="nav-link"  href="{{ url('admin/bills') }}">
              <i class="nc-icon nc-notes"></i>
              <p>Bills</p>
            </a>
					</li>
					<li class="nav-item @yield('active-reports') ">
            <a class="nav-link"  href="{{ url('admin/reports') }}">
              <i class="nc-icon nc-paper-2"></i>
              <p>Reports</p>
            </a>
          </li>


				</ul>
			</div>
		</div>
		<div class="main-panel">
			<!-- Navbar -->
			<nav class="navbar navbar-expand-lg " color-on-scroll="500">
				<div class=" container-fluid  ">
					<a class="navbar-brand" href="#pablo"> Dashboard </a>
					<button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index"
					  aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-bar burger-lines"></span>
						<span class="navbar-toggler-bar burger-lines"></span>
						<span class="navbar-toggler-bar burger-lines"></span>
					</button>
					<div class="collapse navbar-collapse justify-content-end" id="navigation">
						<ul class="nav navbar-nav mr-auto">
							<li class="nav-item">
								<a href="#" class="nav-link" data-toggle="dropdown">
									<i class="nc-icon nc-palette"></i>
									<span class="d-lg-none">Dashboard</span> 
								</a>
							</li>
							
							
						</ul>
						<ul class="navbar-nav ml-auto">
							<li class="nav-item">
								<a class="nav-link" href="#pablo">
									<span class="no-icon"> {{ Auth::user()->name }}</span>
								</a>
							</li>
							
							<li class="nav-item">
								<a class="nav-link" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
																				</a>
																				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
							</li>
						</ul>
					</div>
				</div>
			</nav>
            <!-- End Navbar -->
            

			      
@section('body')
@show






            
			<footer class="footer">
				<div class="container">
					<nav>
						
						<p class="copyright text-center">
							©
							<script>
								document.write(new Date().getFullYear())
							</script>
							<a href="#">Brands Fields</a>
						</p>
					</nav>
				</div>
			</footer>
		</div>
	</div>

</body>
<!--   Core JS Files   -->
<script src="{{ asset('js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/core/popper.min.js') }}"></script>
<script src="{{ asset('js/core/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{ asset('js/plugins/bootstrap-switch.js')}}"></script>

<!--  Notifications Plugin    -->
<script src="{{ asset('js/plugins/bootstrap-notify.js')}}"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="{{ asset('js/light-bootstrap-dashboard.js?v=2.0.1')}}" type="text/javascript"></script>


<script src="{{ asset('js/core/main.js')}}" type="text/javascript"></script>




  

</html>



<script>
$(document).ready(function() {
    $('#example').DataTable();
} );


</script>
@section('script')
           
		   @show
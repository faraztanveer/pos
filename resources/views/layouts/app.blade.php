<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
<!--     Fonts and icons     -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
	<!-- CSS Files -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('css/light-bootstrap-dashboard.css') }}" rel="stylesheet" />
<style>
    body {
        background: url('img/male-bg.jpg');
    }

    #login-card, #reg-card {
        border-radius: 15px;
    }
    .navbar-brand {
        color: #fff !important;
    }
</style>
</head>
<body >
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark text-white navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ route('login') }}">
                   Brands Field
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<!--   Core JS Files   -->
<script src="{{ asset('js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/core/popper.min.js" type="text/javascript')}}"></script>
<script src="{{ asset('js/core/bootstrap.min.js')}}" type="text/javascript"></script>

<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{ asset('js/plugins/bootstrap-switch.js')}}"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="{{ asset('js/plugins/chartist.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{ asset('js/plugins/bootstrap-notify.js')}}"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="{{ asset('js/light-bootstrap-dashboard.js?v=2.0.1')}}" type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ asset('js/demo.js')}}"></script>

<script type="text/javascript">
	$(document).ready(function () {
		// Javascript method's body can be found in assets/js/demos.js
		demo.initDashboardPageCharts();



	});



</script>

<script src="{{ asset('js/core/main.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/app.js') }}"></script>
</html>

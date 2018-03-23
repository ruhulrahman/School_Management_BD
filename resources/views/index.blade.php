<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
		<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
		
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="{{ asset('css/home_style.css') }}">

   <script src="{{ asset('ajax/ajax.js') }}"></script>



        <style>
            html, body {
                background-color: #fff;
                font-family: 'Raleway', sans-serif;
            }
        </style>
	</head>
<body>

<div class="top_home_menu_area fixed-top">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="top_home_menu">
					<div class="home_main_menu">
				<ul>
					<li><a href="{{ url('/features') }}">Features</a></li>
					<li><a href="{{ url('/school_reg') }}">School Registration</a></li>
		            <li><a href="{{ url('/registration') }}">User Registration</a></li>
		            <li><a href="{{ url('/') }}">User Login</a></li>
	            </ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="container"  style="margin-top: 100px; font-size: 14px;">
	@yield('content')
</div>



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>



   </body>
</html>
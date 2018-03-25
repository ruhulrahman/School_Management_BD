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

<script type="text/javascript">
	$(document).ready(function () {                 
		$('#scl_name').keyup(function () {                     
			var scl_name = $('#scl_name').val();                     
			var matches = scl_name.match(/\b(\w)/g);                     
			var scl_code = matches.join('').toUpperCase();                     
			$('#scl_code').val(scl_code);                 
		});             
	});


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#scl_form, #tcr_form').on('submit', function (e) {
                e.preventDefault();
                data = $(this).serialize();
                url = $(this).attr('action');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    success: function (data) {
                        console.log(data);
                        if ($.isEmptyObject(data.errors)) {
                            console.log(data.success);
                            $('#scl_form')[0].reset();
                            $('#tcr_form')[0].reset();
                            $('.text-danger').remove();
//                            $('.control-group').removeClass('has-error').removeClass('has-success');
                            $('.print-success-msg').html(data.success);
                            $('.print-success-msg').css('display', 'block');
                        } else {
                            printMessageErrors(data.errors);
                        }
                    }
                });
            });

            function printMessageErrors(msg) {
                $('.text-danger').remove();
                $.each(msg, function (key, value) {
                    var element = $('#' + key);
                    element.closest('div.control-group')
                            .addClass(value.length > 0 ? 'has-error' : 'has-success');
                    $('.control-label').css('color', '#000');
                    element.after('<span class="text-danger" style="color:red;"><span class="glyphicon glyphicon-exclamation-sign text-danger"></span> ' + value + '</span>');
                });
            }
        </script>

   </body>
</html>
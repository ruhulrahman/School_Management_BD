<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Login</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <link href="{{ asset('public/assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
   <link href="{{ asset('public/assets/bootstrap/css/bootstrap-responsive.min.css') }}" rel="stylesheet" />
   <link href="{{ asset('public/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
   <link href="{{ asset('public/css/style.css') }}" rel="stylesheet" />
   <link href="{{ asset('public/css/style-responsive.css') }}" rel="stylesheet" />
   <link href="{{ asset('public/css/style-default.css') }}" rel="stylesheet" id="style_color" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="lock">
    <div class="lock-header">
        <!-- BEGIN LOGO -->
        <a class="center" id="logo" href="index.html">
            
        </a>
        <h1 style="color:#90BB4F; font-weight: 800">School Management Application</h1>
        <h2 style="color:#F5C147">Welcome to Admin Panel</h2>
        <h2 style="color:red">                       
          <?php
              $message = Session::get('message');
              if($message){
                echo $message;
                Session::put('message', null);
              }
          ?>
                          
        </h2>
        <!-- END LOGO -->
    </div>
    <div class="login-wrap">
        <div class="metro single-size red">
            <div class="locked">
                <i class="icon-lock"></i>
                <span>Login</span>
            </div>
        </div>


        <form action="{{ url('/admin-login/') }}" method="post">
            {{ csrf_field() }}

        <div class="metro double-size green">
            <div class="input-append lock-input">
                <input name="scl_email" type="text" class="" placeholder="Enter school email" required="required">
            </div>
        </div>
        <div class="metro double-size yellow">
            <div class="input-append lock-input">
                <input name="password" type="password" class="" placeholder="Enter password" required="required">
            </div>
        </div>
        <div class="metro single-size terques login">
            <button type="submit" class="btn login-btn">
                Login
                <i class=" icon-long-arrow-right"></i>
            </button>
        </div>

        </form>

    </div>
</body>
<!-- END BODY -->
</html>
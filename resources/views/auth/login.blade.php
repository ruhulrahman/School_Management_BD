@extends('index')
@section('content')
@section('title', 'SMS Login')

<style>
    .form-signin
{
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
}
.form-signin .form-signin-heading, .form-signin .checkbox
{
    margin-bottom: 10px;
}
.form-signin .checkbox
{
    font-weight: normal;
}
.form-signin .form-control
{
    position: relative;
    font-size: 16px;
    height: auto;
    padding: 10px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.form-signin .form-control:focus
{
    z-index: 2;
}
.form-signin input[type="text"]
{
    margin-bottom: -1px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}
.form-signin input[type="password"]
{
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
.account-wall
{
    margin-top: 20px;
    padding: 40px 0px 20px 0px;
    background-color: #f7f7f7;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}
.login-title
{
    color: #555;
    font-size: 18px;
    font-weight: 400;
    display: block;
}
.profile-img
{
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}
.need-help
{
    margin-top: 10px;
}
.new-account
{
    display: block;
    margin-top: 10px;
}
</style>

    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">

                <h3 style="color:red; text-align: center;">                       
                  <?php
                      $message = Session::get('message');
                      if($message){
                        echo $message;
                        Session::put('message', null);
                      }
                  ?>                          
                </h3>
            <h1 class="text-center login-title">Login in to continue</h1>
            <div class="account-wall">
                <h2 class="text-center text-success">Student, Teacher and Admin Teacher's Login Panel</h2>
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
                <form action="{{ url('/user-login-check') }}" method="post" id="" class="form-signin">
                    {{ csrf_field() }}
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email" autofocus><br>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password">
                    <button style="font-size: 16px;" class="btn btn-lg btn-primary btn-block" type="submit">
                        Login in</button>
                    <a href="#" class="pull-right need-help" style="font-size: 14px;">Need help? </a><span class="clearfix"></span>
                </form>
            </div>
            <a href="{{ asset('/registration') }}" class="text-center new-account" style="font-size: 14px; font-weight: 800;">Create an account </a>
        </div>
    </div>
@endsection
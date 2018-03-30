@extends('index')
@section('content')
@section('title', 'Student/Teacher Registration')
<style>
	
.panel-login {
	border-color: #ccc;
	-webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	-moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
}
.panel-login>.panel-heading {
	color: #00415d;
	background-color: #fff;
	border-color: #fff;
	text-align:center;
}
.panel-login>.panel-heading a{
	text-decoration: none;
	color: #666;
	font-weight: bold;
	font-size: 15px;
	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	transition: all 0.1s linear;
}
.panel-login>.panel-heading a.active{
	color: #029f5b;
	font-size: 18px;
}
.panel-login>.panel-heading hr{
	margin-top: 10px;
	margin-bottom: 0px;
	clear: both;
	border: 0;
	height: 1px;
	background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
	background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
	background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
	background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
}
.panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="date"],.panel-login input[type="password"] {
	height: 45px;
	border: 1px solid #ddd;
	font-size: 16px;
	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	transition: all 0.1s linear;
}
.panel-login input:hover,
.panel-login input:focus {
	outline:none;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
	border-color: #ccc;
}
.btn-login {
	background-color: #59B2E0;
	outline: none;
	color: #fff;
	font-size: 14px;
	height: auto;
	font-weight: normal;
	padding: 14px 0;
	text-transform: uppercase;
	border-color: #59B2E6;
}
.btn-login:hover,
.btn-login:focus {
	color: #fff;
	background-color: #53A3CD;
	border-color: #53A3CD;
}
.forgot-password {
	text-decoration: underline;
	color: #888;
}
.forgot-password:hover,
.forgot-password:focus {
	text-decoration: underline;
	color: #666;
}

.btn-register {
	background-color: #1CB94E;
	outline: none;
	color: #fff;
	font-size: 14px;
	height: auto;
	font-weight: normal;
	padding: 14px 0;
	text-transform: uppercase;
	border-color: #1CB94A;
}
.btn-register:hover,
.btn-register:focus {
	color: #fff;
	background-color: #1CA347;
	border-color: #1CA347;
}

select.form-control:not([size]):not([multiple]) {
    height: calc(2.19rem + 15px);
}
.form-control{
    font-size: 14px;
}


</style>

    	<div class="row content">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-12">
								<h1 class="panel-heading" style="text-shadow: 0px 1px 2px #333; color: blue; text-decoration: underline; margin-bottom: 15px;">Welcome to User Registration</h1>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Student Registraion</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Teacher Registration</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
                                 
                <div class="print-success-msg alert alert-success  text-center" style="display: none;"></div>
   
<div id="login-form" style="display: block;">
				<form action="{{ url('/user_registration') }}" method="post" id="scl_form" class="form-horizontal" role="form">
                <h2>Student Registration Form</h2>
                {{ csrf_field() }}                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Full Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" placeholder="Full Name" class="form-control" autofocus required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" id="email" placeholder="Email" class="form-control" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-sm-3 control-label">Phone</label>
                    <div class="col-sm-9">
                        <input type="phone" name="phone" id="phone" placeholder="Phone" class="form-control" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="scl_code" class="col-sm-3 control-label">School code</label>
                    <div class="col-sm-9">
                        <input type="text" name="scl_code" id="scl_code" placeholder="School code" class="form-control" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="class_id" class="col-sm-3 control-label">Class Name</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="class_id" id="class_id">
                            <?php $classes = DB::table('class')->get(); ?>
                                <option value="">Select Class Name</option>
                            @foreach ($classes as $cls)
                                <option value="{{ $cls->id }}">{{ $cls->class_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="date_of_birth" class="col-sm-3 control-label">Date of Birth</label>
                    <div class="col-sm-9">
                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Gender</label>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" id="gender" value="male">Male
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" id="gender" value="female">Female
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" id="gender" value="Unknown" required="required">Unknown
                                </label>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.form-group -->
                <div class="form-group">
                    <label for="country" class="col-sm-3 control-label">Religion</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="religion" id="religion">
                            <option value="Muslim">Muslim</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Christan">Christan</option>
                            <option value="Buddist">Buddist</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                </div> <!-- /.form-group -->
                <div class="form-group">
                    <label for="country" class="col-sm-3 control-label">Country</label>
                    <div class="col-sm-9">
                        <?php
                        $countries = DB::table('country')->get();
                        ?>
                        <select class="form-control" name="country_id" id="country_id" onchange="ajaxGET('create_division_id','{{URL::to('/division/')}}/'+this.value)">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                            @if ($country->country_name == 'Bangladesh')
                            <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                            @else
                            <option value="{{ $country->id }}" disabled="disabled">{{ $country->country_name }}</option>
                            @endif

                            @endforeach
                        </select>
                    </div>
                </div> <!-- /.form-group -->

                <div class="form-group">
                    <label for="country" class="col-sm-3 control-label">Division</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="create_division_id" id="create_division_id" onchange="ajaxGET('create_dist_id','{{URL::to('/district/')}}/'+this.value)">
                            <option value="">Select Country First</option>
                        </select>
                    </div>
                </div> <!-- /.form-group -->

                <div class="form-group">
                    <label for="country" class="col-sm-3 control-label">District</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="create_dist_id" id="create_dist_id" onchange="ajaxGET('create_thana_id','{{URL::to('/thana/')}}/'+this.value)">
                            <option value="">Select Division First</option>
                        </select>
                    </div>
                </div> <!-- /.form-group -->

                <div class="form-group">
                    <label for="country" class="col-sm-3 control-label">Thana</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="create_thana_id" id="create_thana_id">
                            <option value="">Select District First</option>
                        </select>
                    </div>
                </div> <!-- /.form-group -->

                <div class="form-group">
                    <label for="scl_adress" class="col-sm-3 control-label">Your Address</label>
                    <div class="col-sm-9">
                        <input type="text" name="address" id="address" placeholder="Enter Your Address" class="form-control" required="required">
                    </div>
                </div>

                <!--<div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox">I accept <a href="#">terms</a>
                            </label>
                        </div>
                    </div>
                </div> /.form-group -->
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" style="font-size: 14px;" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>
            </form>

</div>



<div id="register-form"  style="display: none;">
			<form action="{{ url('/user_registration_teacher') }}" method="post" id="tcr_form" class="form-horizontal" role="form">
                {{ csrf_field() }}
                <h2>Teacher Registration Form</h2>
                <div class="form-group">
                    <label for="name_tcr" class="col-sm-3 control-label">Full Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="name_tcr" id="name_tcr" placeholder="Full Name" class="form-control" autofocus required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email_tcr" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" name="email_tcr" id="email_tcr" placeholder="Email" class="form-control" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone_tcr" class="col-sm-3 control-label">Phone</label>
                    <div class="col-sm-9">
                        <input type="phone" name="phone_tcr" id="phone_tcr" placeholder="Phone" class="form-control" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="scl_code_tcr" class="col-sm-3 control-label">School code</label>
                    <div class="col-sm-9">
                        <input type="scl_code" name="scl_code_tcr" id="scl_code_tcr" placeholder="School code" class="form-control" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="rank_tcr" class="col-sm-3 control-label">Rank</label>
                    <div class="col-sm-9">
                        <input type="rank" name="rank_tcr" id="rank_tcr" placeholder="rank" class="form-control" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_tcr" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" name="password_tcr" id="password_tcr" placeholder="Password" class="form-control" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="date_of_birth_tcr" class="col-sm-3 control-label">Date of Birth</label>
                    <div class="col-sm-9">
                        <input type="date" name="date_of_birth_tcr" id="date_of_birth_tcr" class="form-control" required="required">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-3">Gender</label>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" name="gender_tcr" id="gender_tcr" value="female">Male
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" name="gender_tcr" id="gender_tcr" value="male">Female
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" name="gender_tcr" id="gender_tcr" value="Unknown" required="required">Unknown
                                </label>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.form-group -->
                <div class="form-group">
                    <label for="religion_tcr" class="col-sm-3 control-label">Religion</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="religion_tcr" id="religion_tcr" required="required">
                            <option value="Muslim">Muslim</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Christan">Christan</option>
                            <option value="Buddist">Buddist</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                </div> <!-- /.form-group -->
                <div class="form-group">
                    <label for="country" class="col-sm-3 control-label">Country</label>
                    <div class="col-sm-9">
                        <?php
                        $countries = DB::table('country')->get();
                        ?>
                        <select class="form-control" name="country_id" id="country_id" onchange="ajaxGET('create_division_id_teacher','{{URL::to('/division/')}}/'+this.value)">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                            @if ($country->country_name == 'Bangladesh')
                            <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                            @else
                            <option value="{{ $country->id }}" disabled="disabled">{{ $country->country_name }}</option>
                            @endif

                            @endforeach
                        </select>
                    </div>
                </div> <!-- /.form-group -->

                <div class="form-group">
                    <label for="country" class="col-sm-3 control-label">Division</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="create_division_id_teacher" id="create_division_id_teacher" onchange="ajaxGET('create_dist_id_teacher','{{URL::to('/district/')}}/'+this.value)">
                            <option value="">Select Country First</option>
                        </select>
                    </div>
                </div> <!-- /.form-group -->

                <div class="form-group">
                    <label for="country" class="col-sm-3 control-label">District</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="create_dist_id_teacher" id="create_dist_id_teacher" onchange="ajaxGET('create_thana_id_teacher','{{URL::to('/thana/')}}/'+this.value)">
                            <option value="">Select Division First</option>
                        </select>
                    </div>
                </div> <!-- /.form-group -->

                <div class="form-group">
                    <label for="country" class="col-sm-3 control-label">Thana</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="create_thana_id_teacher" id="create_thana_id_teacher">
                            <option value="">Select District First</option>
                        </select>
                    </div>
                </div> <!-- /.form-group -->

                <div class="form-group">
                    <label for="address_tcr" class="col-sm-3 control-label">Your Address</label>
                    <div class="col-sm-9">
                        <input type="text" name="address_tcr" id="address_tcr" placeholder="Enter Your Address" class="form-control" required="required">
                    </div>
                </div>
                <!--<div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <div class="checkbox">
                            <label>
                                <input name="checkbox" id="checkbox" type="checkbox">I accept <a href="#">terms</a>
                            </label>
                        </div>
                    </div>
                </div>  /.form-group -->
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" style="font-size: 14px;" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>
            </form>
</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


<script type="text/javascript">
    function ajaxGET(div, url, data) {
        var xmlhttp;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function () {
            $('#' + div).html("").css('color', '#000');
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                $('#' + div).append(xmlhttp.responseText);
//                document.getElementById(div).innerHTML = xmlhttp.responseText;
            } else {
                if (div == 'create_division_id_teacher') {
                    document.getElementById(div).innerHTML = '<option value="">Select Country First</option>';
                    $('#' + div).css('color', 'red');
                } else if (div == 'create_dist_id_teacher') {
                    document.getElementById(div).innerHTML = '<option value="">Select Division/State First</option>';
                    $('#' + div).css('color', 'red');
                } else if (div == 'create_thana_id_teacher') {
                    document.getElementById(div).innerHTML = '<option value="">Select District First</option>';
                    $('#' + div).css('color', 'red');
                }
            }
        };
        xmlhttp.open("GET", url, true);
        xmlhttp.send(data);
    }
</script>


@endsection
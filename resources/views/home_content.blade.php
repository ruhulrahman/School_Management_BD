@extends('index')
@section('content')

<style>
	.option_list{
		margin: 0;
		list-style-type: space-counter;
	}
	.option_list li{}
	.option_list li a{
		padding: 5px 0px;
		display: block;
		text-decoration: none;
	}
	.option_list li a:hover{
		color: orange;
	}
</style>

<div class="row">

	<h1 class="text-success" style="font-size: 36px; max-width: 800px; margin:0 auto; text-align: right; margin-bottom: 50px; font-weight: 800; text-align: center;">Welcome to School Management System</h1>	
	<div class="col-lg-5">
		<h1 class="text-danger">A complete school integrated solution in this website.</h1>
		<p>Dont' waste your time. Registrater in our site and manage your school very easily. </p>
		<h1>How many option you will get from here:-</h1>
		<ul class="option_list">
			<li><a href="">Student Management</a></li>
			<li><a href="">Teacher Management</a></li>
			<li><a href="">User Management</a></li>
			<li><a href="">Parents Management</a></li>
			<li><a href="">Exam Management</a></li>
			<li><a href="">Fees Management</a></li>
			<li><a href="">Result Management</a></li>
			<li><a href="">Notice Board Management</a></li>
			<li><a href="">Notification Management</a></li>
			<li><a href="">Report Management</a></li>
			<li><a href="">Class Routine Management</a></li>
			<li><a href="">Staff Management</a></li>
			<li><a href="">Staff Salary Management</a></li>
			<li><a href="">Staff Promotion Management</a></li>
			<li><a href="">Techer-Student Conversation</a></li>
			<li><a href="">Techer-Techer Conversation</a></li>
			<li><a href="">Student-Student Conversation</a></li>
			<li><a href="">Admin Panel</a></li>
		</ul>
	</div>
	<div class="col-lg-7">
		<img src="{{ asset('img/school-management-soft.jpg') }}" width="100%" alt="">
	</div>
</div>

@endsection
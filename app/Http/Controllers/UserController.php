<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class UserController extends Controller
{
    public function getUsers()
    {
    	$users = DB::table('users')-get();
    	return $users;
    }


    public function index()
    {
    	return view('user_reg');
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Validator;
use DB;
use Session;

session_start();

class UserController extends Controller
{
    public function getUsers()
    {
    	$users = DB::table('users')-get();
    	return $users;
    }

    public function user_registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'scl_code' => 'required',
                    'class_id' => 'required',
                    'email' => 'unique:users,email',
                    'phone' => 'unique:users,phone',
                    'create_thana_id' => 'required',
                        ], [
                    'scl_code.required' => 'You can\'t leave this empty.',
                    'class_id.required' => 'You can\'t leave this empty.',
                    'email.unique' => 'This email already taken.',
                    'phone.unique' => 'This phone number already taken.',
                    'create_thana_id.required' => 'You can\'t leave this empty.',
        ]);
        $validator2 = Validator::make($request->all(), [
                    'scl_code' => 'unique:schools_reg,scl_code',
                        ]);

        if ($validator->passes()):
            if ($request->gender == 'male') {            
                $img_path = 'public/img/male.png';
            } else {
                $img_path = 'public/img/female.png';
            }
            $rand = rand(1000,9999);

            $tableInfo = array();
            $tableInfo['name'] = $request->name;
            $tableInfo['email'] = $request->email;
            $tableInfo['phone'] = $request->phone;
            $tableInfo['scl_code'] = $request->scl_code;
            $tableInfo['class_id'] = $request->class_id;
            $tableInfo['password'] = md5($request->password);
            $tableInfo['date_of_birth'] = $request->date_of_birth;
            $tableInfo['gender'] = $request->gender;
            $tableInfo['religion'] = $request->religion;
            $tableInfo['thana_id'] = $request->create_thana_id;
            $tableInfo['address'] = $request->address;
            $tableInfo['slug'] = $request->name.$request->phone;
            $tableInfo['pic'] = $img_path;
            $tableInfo['user_type'] = 'student';
            $tableInfo['status'] = $rand;
            $tableInfo['created_at'] = date('Y-m-d H:i:s');

            if ($validator2->passes()) {
                return response()->json(['errors' => array('scl_code' => 'Not match')]);
            }else{
                DB::table('users')->insert($tableInfo);
            }
          
            
            
            return response()->json(['success' => 'User Registration Successfully Submited']);
            //Session::put('success', 'School Registtration Submited successfully');
            //return Redirect::to('/school_reg');
        else:
            return response()->json(['errors' => $validator->errors()]);
        endif;
    }


    public function user_registration_teacher(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'scl_code_tcr' => 'required',
                    'gender_tcr' => 'required',
                    'email_tcr' => 'unique:users,email',
                    'phone_tcr' => 'unique:users,phone',
                    'create_thana_id_teacher' => 'required',
                        ], [
                    'scl_code_tcr.required' => 'You can\'t leave this empty.',
                    'gender_tcr.required' => 'You can\'t leave this empty.',
                    'email_tcr.unique' => 'This email already taken.',
                    'phone_tcr.unique' => 'This phone number already taken.',
                    'create_thana_id_teacheruired' => 'You can\'t leave this empty.',
        ]);

        if ($validator->passes()):
            if ($request->gender == 'male') {            
                $img_path = 'public/img/male.png';
            } else {
                $img_path = 'public/img/female.png';
            }
            $rand = rand(1000,9999);
            $tableInfo = array();
            $tableInfo['name'] = $request->name_tcr;
            $tableInfo['email'] = $request->email_tcr;
            $tableInfo['phone'] = $request->phone_tcr;
            $tableInfo['scl_code'] = $request->scl_code_tcr;
            $tableInfo['password'] = md5($request->password_tcr);
            $tableInfo['date_of_birth'] = $request->date_of_birth_tcr;
            $tableInfo['gender'] = $request->gender_tcr;
            $tableInfo['religion'] = $request->religion_tcr;
            $tableInfo['thana_id'] = $request->create_thana_id_teacher;
            $tableInfo['address'] = $request->address_tcr;
            $tableInfo['slug'] = $request->name.$request->phone_tcr;
            $tableInfo['pic'] = $img_path;
            $tableInfo['user_type'] = 'teacher';
            $tableInfo['rank'] = $request->rank_tcr;
            $tableInfo['status'] = $rand;
            $tableInfo['created_at'] = date('Y-m-d H:i:s');
          
            DB::table('users')->insert($tableInfo);
            
            return response()->json(['success' => 'User Registration Successfully Submited']);
            //Session::put('success', 'School Registtration Submited successfully');
            //return Redirect::to('/school_reg');
        else:
            return response()->json(['errors' => $validator->errors()]);
        endif;
    }


    public function user_login_check(Request $request){
        $email = $request->email;
        $password = md5($request->password);

        $user_check = DB::table('users')
                        ->where('email', $email)
                        ->where('password', $password)
                        ->first();
        //$scl_info = DB::table('schools_reg')->get();
        
        if($user_check){
            $activation_check = DB::table('users')
                        ->where('id', $user_check->id)
                        ->where('status', '1')
                        ->first();
            if($activation_check){
                $scl_check = DB::table('schools_reg')
                                ->where('scl_code', $activation_check->scl_code)
                                ->first();
                if(date('Y-m-d') < $scl_check->scl_expire_date){                   
                    Session::put('UserName', $user_check->name);
                    Session::put('UserSlug', $user_check->slug);
                    Session::put('UserID', $user_check->id);
                    if($user_check->user_type == 'student'){
                        return Redirect::to('/user-dashboard');
                    }elseif($user_check->user_type == 'teacher'){
                        return Redirect::to('/tcr-dashboard');
                    }else{
                        return Redirect::to('/tcr-admin-dashboard');
                    }
                    
                }else{
                    Session::put('message', 'Your School expire date has been over!!');
                    return Redirect::to('/');
                }
            }else {
                Session::put('message', 'You are not activated user!!');
                return Redirect::to('/');
            }
        }else{
            Session::put('message', 'User email and password not match!!');
            return Redirect::to('/');
        }

    }


    public function user_dashboard() {
        $userId = Session::get('UserID');
        if ($userId == Null) {
            return Redirect::to('/')->send();
        }
        $users = DB::table('users')->where('id', $userId)->get();
        //$school_reg = DB::table('school_reg')->count();
        $user_page_content = view('users.user_page_content');
        return view('users.user_dashboard')
        ->with('users', $users)
        ->with('page_content', $user_page_content);
    }


    public function tcr_dashboard() {
        $userId = Session::get('UserID');
        if ($userId == Null) {
            return Redirect::to('/')->send();
        }
        $users = DB::table('users')->where('id', $userId)->get();
        //$school_reg = DB::table('school_reg')->count();
        $user_page_content = view('teacher.tcr_page_content');
        return view('teacher.tcr_dashboard')
        ->with('users', $users)
        ->with('page_content', $user_page_content);
    }

    public function tcr_admin_dashboard() {
        $userId = Session::get('UserID');
        if ($userId == Null) {
            return Redirect::to('/')->send();
        }
        $users = DB::table('users')->where('id', $userId)->get();
        //$school_reg = DB::table('school_reg')->count();
        $user_page_content = view('admins.admins_page_content');
        return view('admins.admins_dashboard')
        ->with('users', $users)
        ->with('page_content', $user_page_content);
    }


    public function logout_user(){
        Session::put('UserName', null);
        Session::put('UserSlug', null);
        Session::put('UserID', null);
        Session::put('message', 'You are successfully logout');
        return Redirect::to('/');
    }




}

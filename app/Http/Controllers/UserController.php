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
            $tableInfo['slug'] = $request->name.$request->phone.$rand;
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
            $tableInfo['slug'] = $request->name_tcr.$request->phone_tcr.$rand;
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
                        ->join('schools_reg', 'users.scl_code', '=', 'schools_reg.scl_code')
                        ->where('email', $email)
                        ->where('password', $password)
                        ->select('users.*', 'schools_reg.scl_expire_date')
                        ->first();
        //$scl_info = DB::table('schools_reg')->get();
        
        if($user_check){
            if($user_check->status == '1'){
                if(date('Y-m-d') < $user_check->scl_expire_date){                   
                    Session::put('UserName', $user_check->name);
                    Session::put('UserSlug', $user_check->slug);
                    Session::put('UserID', $user_check->id);
                    Session::put('SCL_code', $user_check->scl_code);

                    Session::put('Power', $user_check->power);
                    Session::put('UserType', $user_check->user_type);

                    if($user_check->user_type == 'student'){
                        return Redirect::to('/student');
                    }elseif($user_check->user_type == 'teacher' && $user_check->power != 'admin'){
                        return Redirect::to('/teacher');
                    }elseif($user_check->user_type == 'teacher' && $user_check->power == 'admin'){
                        return Redirect::to('/admin');
                    }else{
                        return Redirect::to('/');
                    }
                    
                }else{
                    Session::put('message', 'Your School expire date has been over!!');
                    return Redirect::to('/');
                }



            }elseif($user_check->status == '0'){
                Session::put('message', 'You are block user!!');
                return Redirect::to('/');
            }else {
                Session::put('message', 'Your account didn\'t not activated!!');
                return Redirect::to('/');
            }
        }else{
            Session::put('message', 'User email and password not match!!');
            return Redirect::to('/');
        }

    }


    public function user_dashboard() {
        $userId = Session::get('UserID');        
        $UserType = Session::get('UserType');
        $Power = Session::get('Power');
        if ($userId == Null) {
            return Redirect::to('/')->send();
        }elseif($UserType == 'student' && $Power == Null){
            $users = DB::table('users')->where('id', $userId)->get();
            //$school_reg = DB::table('school_reg')->count();
            $user_page_content = view('users.user_page_content');
            return view('users.user_dashboard')
            ->with('users', $users)
            ->with('page_content', $user_page_content);
        }else{
          return Redirect::to('/')->send();  
        }
    }

    public function class_routine_add()
    {
        $userId = Session::get('UserID');

        $days = DB::table('days')                    
                    ->orderBy('id', 'asc')
                    ->get();

        $users = DB::table('users')->where('id', $userId)->first();

        $index_content = view('admins.add_class_routine')
                        ->with('Days', $days);

        return view('admins.admins_dashboard')
                        ->with('page_content', $index_content)                        
                        ->with('users', 'Ruhul'); 
    }


    public function tcr_dashboard() {
        $userId = Session::get('UserID');        
        $UserType = Session::get('UserType');
        $Power = Session::get('Power');
        if ($userId == Null) {
            return Redirect::to('/')->send();
        }elseif($UserType == 'teacher' && $Power != 'admin'){
            $users = DB::table('users')->where('id', $userId)->get();
            //$school_reg = DB::table('school_reg')->count();
            $user_page_content = view('teacher.tcr_page_content');
            return view('teacher.tcr_dashboard')
            ->with('users', $users)
            ->with('page_content', $user_page_content);
        }else{
           return Redirect::to('/')->send(); 
        }
    }

    public function tcr_admin_dashboard() {
        $userId = Session::get('UserID');
        $UserType = Session::get('UserType');
        $Power = Session::get('Power');
        if ($userId == Null) {
            return Redirect::to('/')->send();
        }else if($UserType == 'teacher' && $Power == 'admin'){
            $users = DB::table('users')->where('id', $userId)->get();
            //$school_reg = DB::table('school_reg')->count();
            $user_page_content = view('admins.admins_page_content');
            return view('admins.admins_dashboard')
            ->with('users', $users)
            ->with('page_content', $user_page_content);  
        }else{
            return Redirect::to('/')->send();
        }
    }


    public function logout_user(){
        Session::put('UserName', null);
        Session::put('UserSlug', null);
        Session::put('UserID', null);
        Session::put('UserType', null);
        Session::put('UserID', null);
        Session::put('message', 'You are successfully logout');
        return Redirect::to('/');
    }




}

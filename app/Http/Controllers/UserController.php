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


    public function index()
    {
    	return view('user_reg');
    }

    public function user_registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'scl_code' => 'required',
                    'email' => 'unique:users,email',
                    'phone' => 'unique:users,phone',
                    'create_thana_id' => 'required',
                        ], [
                    'scl_code.required' => 'You can\'t leave this empty.',
                    'email.unique' => 'This email already taken.',
                    'phone.unique' => 'This phone number already taken.',
                    'create_thana_id.required' => 'You can\'t leave this empty.',
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
            $tableInfo['password'] = $request->password;
            $tableInfo['date_of_birth'] = $request->date_of_birth;
            $tableInfo['gender'] = $request->gender;
            $tableInfo['religion'] = $request->religion;
            $tableInfo['thana_id'] = $request->create_thana_id;
            $tableInfo['address'] = $request->address;
            $tableInfo['slug'] = $request->name.$request->phone;
            $tableInfo['pic'] = $img_path;
            $tableInfo['user_type'] = 'student';
            $tableInfo['status'] = $rand;
          
            DB::table('users')->insert($tableInfo);
            
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
                    'create_thana_id_teacher.required' => 'You can\'t leave this empty.',
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
            $tableInfo['password'] = $request->password_tcr;
            $tableInfo['date_of_birth'] = $request->date_of_birth_tcr;
            $tableInfo['gender'] = $request->gender_tcr;
            $tableInfo['religion'] = $request->religion_tcr;
            $tableInfo['thana_id'] = $request->create_thana_id_teacher_tcr;
            $tableInfo['address'] = $request->address_tcr;
            $tableInfo['slug'] = $request->name.$request->phone_tcr;
            $tableInfo['pic'] = $img_path;
            $tableInfo['user_type'] = 'teacher';
            $tableInfo['rank'] = $request->rank_tcr;
            $tableInfo['status'] = $rand;
          
            DB::table('users')->insert($tableInfo);
            
            return response()->json(['success' => 'User Registration Successfully Submited']);
            //Session::put('success', 'School Registtration Submited successfully');
            //return Redirect::to('/school_reg');
        else:
            return response()->json(['errors' => $validator->errors()]);
        endif;
    }


}

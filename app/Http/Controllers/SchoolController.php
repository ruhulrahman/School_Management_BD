<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use DB;
use Validator;
use Session;
session_start();

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Session::get('UserID');        
        $UserType = Session::get('UserType');
        $Power = Session::get('Power');

        if ($userId != Null) {
            if($UserType == 'student' && $Power == Null){
               return Redirect::to('/student')->send(); 
            }

            if($UserType == 'teacher' && $Power != 'admin'){
               return Redirect::to('/teacher')->send(); 
            }
            if($UserType == 'teacher' && $Power == 'admin'){
               return Redirect::to('/admin')->send(); 
            }
        }
        
        return view('auth.login');
    }


    public function features()
    {
        $features = DB::table('features')->get();
        $home_content = view('home_content')->with('features', $features);
        return view('index')->with('content', $home_content);
    }

    public function login()
    {
        
        return view('auth.login');
    }
    
    public function registration()
    {
        
        $reg =  view('auth.registration');
        $home_content = view('home_content');
        return view('index')->with('content', $reg);
    }

    public function school_reg()
    {
        
        return view('auth.school_reg');
    }




    public function scl_registration_submit(Request $request) {

        $validator = Validator::make($request->all(), [
                    'scl_code' => 'unique:schools_reg,scl_code',
                    'scl_email' => 'unique:schools_reg,scl_email',
                    'scl_phone' => 'unique:schools_reg,scl_phone',
                    'create_thana_id' => 'required',
                        ], [
                    'scl_code.unique' => 'This school code already added.',
                    'scl_email.unique' => 'This email already taken.',
                    'scl_phone.unique' => 'This phone number already taken.',
                    'create_thana_id.required' => 'You can\'t leave this empty.',
        ]);

        if ($validator->passes()):
            $tableInfo = array();
            $tableInfo['scl_name'] = $request->scl_name;
            $tableInfo['scl_code'] = $request->scl_code;
            $tableInfo['scl_email'] = $request->scl_email;
            $tableInfo['scl_phone'] = $request->scl_phone;
            $tableInfo['scl_establish_date'] = $request->scl_establish_date;
            $tableInfo['thana_id'] = $request->create_thana_id;
            $tableInfo['scl_address'] = $request->scl_address;
            $tableInfo['scl_expire_date'] = $request->scl_expire_date;
            $tableInfo['scl_password'] = md5($request->scl_password);
            $tableInfo['created_at'] = date('Y-m-d h:i:s');
            
            DB::table('schools_reg')->insert($tableInfo);
            
            return response()->json(['success' => 'School Registration Successfully Submited']);
            //Session::put('success', 'School Registtration Submited successfully');
            //return Redirect::to('/school_reg');
        else:
            return response()->json(['errors' => $validator->errors()]);
        endif;
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

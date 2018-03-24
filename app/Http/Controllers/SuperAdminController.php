<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Validator;
use DB;
use Session;

session_start();

class SuperAdminController extends Controller {

    public function __construct() {
        $superAdminId = Session::get('superAdminId');
    }

    public function index() {
        $superAdminId = Session::get('superAdminId');
        if ($superAdminId != Null) {
            return Redirect::to('/super-dashboard/')->send();
        }
        return view('admin.login');
    }

    public function super_dashboard() {
        $superAdminId = Session::get('superAdminId');
        if ($superAdminId == Null) {
            return Redirect::to('/super/')->send();
        }
        $superAdmin = DB::table('super_admin')->get();
        //$school_reg = DB::table('school_reg')->count();


        $index_content = view('admin.index_page_content');
        return view('admin.index')->with('page_content', $index_content);
    }

    public function superAdminLogin(Request $request) {
        $username = $request->username;
        $password = md5($request->password);

        $superAdminQuery = DB::table('super_admin')
                ->where('username', $username)
                ->where('password', $password)
                ->first();
        if ($superAdminQuery) {
            Session::put('SuperAdminName', $superAdminQuery->name);
            Session::put('superAdminId', $superAdminQuery->id);

            return Redirect::to('/super-dashboard/');
        } else {
            Session::put('exception', 'User email and password not match!!');
            return Redirect::to('/super/');
        }
    }

    public function location() {
        $index_content = view('admin.location');
        return view('admin.index')->with('page_content', $index_content);
    }

    public function division($id) {
        $country_id = $id;
        $division = DB::table('division')->where('country_id', $country_id)->get();
        echo '<option value="">Select Country</option>';
        foreach ($division as $dvn):
            echo '<option value="' . $dvn->id . '">' . $dvn->division_name . '</option>';
        endforeach;
    }

    public function district($id) {
        $divesion_id = $id;
        $district = DB::table('district')->where('division_id', $divesion_id)->get();
        echo '<option value="">Select District</option>';
        foreach ($district as $dist):
            echo '<option value="' . $dist->id . '">' . $dist->district_name . '</option>';
        endforeach;
    }

    public function thana($id) {
        $thana = DB::table('thana')->where('district_id', $id)->get();
        echo '<option value="">Select Thana</option>';
        foreach ($thana as $thn):
            echo '<option value="' . $thn->id . '">' . $thn->thana_name . '</option>';
        endforeach;
    }

    public function country_create(Request $request) {
        $country = $request->country;


        $create_country = DB::table('country')->insert([
            'country_name' => $country
        ]);
        if ($create_country) {
            Session::put('message', 'Country added successfully');
            return Redirect::to('/location');
        } else {
            Session::put('message', 'Country not added!');
        }
    }

    public function division_create(Request $request) {
        $division_name = $request->division_name;
        $country_id = $request->country_id;


        $create = DB::table('division')->insert([
            'division_name' => $division_name,
            'country_id' => $country_id,
        ]);
        if ($create) {
            Session::put('message', 'Division added successfully');
            return Redirect::to('/location');
        } else {
            Session::put('message', 'Division not added!');
        }
    }

    public function district_create(Request $request) {
        $district_name = $request->district_name;
        $division_id = $request->division_id;


        $create = DB::table('district')->insert([
            'district_name' => $district_name,
            'division_id' => $division_id,
        ]);
        if ($create) {
            Session::put('message', 'District added successfully');
            return Redirect::to('/location');
        } else {
            Session::put('message', 'District not added!');
        }
    }

    public function selectAjax(Request $request) {
        if ($request->ajax()) {
            $states = DB::table('district')->where('division_id', $request->division_id)->all();
            $data = view('ajax-select', compact('states'))->render();
            return response()->json(['options' => $data]);
        }
    }

    public function thana_create(Request $request) {

        $crt_thana_validator = Validator::make($request->all(), [
                    'country_id' => 'required',
                    'create_thana_division_id' => 'required',
                    'create_thana_dist_id' => 'required',
                    'thana' => 'required|unique:thana,thana_name',
                        ], [
                    'country_id.required' => 'You can\'t leave this empty.',
                    'create_thana_division_id.required' => 'You can\'t leave this empty.',
                    'create_thana_dist_id.required' => 'You can\'t leave this empty.',
                    'thana.required' => 'You can\'t leave this empty.',
                    'thana.unique' => 'This police station already added.',
        ]);

        if ($crt_thana_validator->passes()):
            $thanaInfo = array();
            $thanaInfo['thana_name'] = $request->thana;
            $thanaInfo['district_id'] = $request->create_thana_dist_id;
            
            DB::table('thana')->insert($thanaInfo);
            
            return response()->json(['success' => '!!! Police Station successfully added. !!!']);
        else:
            return response()->json(['errors' => $crt_thana_validator->errors()]);
        endif;



//        $thana_name = $request->thana_name;
//        $thana_id = $request->thana_id;
//
//
//        $create = DB::table('thana')->insert([
//                    'thana_name' => $thana_name,
//                    'thana_id' => $thana_id,
//                ]);
//        if($create){
//            Session::put('message', 'Thana added successfully');
//            return Redirect::to('/location');
//        }else{
//            Session::put('message', 'Thana not added!');
//        }
    }

    public function class_routine() {
        $days = DB::table('days')                    
                    ->orderBy('id', 'asc')
                    ->get();
        $index_content = view('admin.class_routine')
                ->with('Days', $days);

        return view('admin.index')
                        ->with('page_content', $index_content);
    }

    public function school_reg_req() {
        $scl_reqs = DB::table('schools_reg')
                    ->leftJoin('thana', 'thana.id', '=', 'schools_reg.thana_id')
                    ->rightJoin('district', 'district.id', '=', 'thana.district_id')
                    ->where('status', '0')
                    ->orderBy('schools_reg.id', 'desc')
                    ->select('schools_reg.*', 'thana.thana_name', 'district.district_name')
                    ->get();
        $index_content = view('admin.scl_request')
                ->with('scl_reqs', $scl_reqs);

        return view('admin.index')
                        ->with('page_content', $index_content);
    }

    public function scl_list() {
        $scl_reqs = DB::table('schools_reg')
                    ->leftJoin('thana', 'thana.id', '=', 'schools_reg.thana_id')
                    ->rightJoin('district', 'district.id', '=', 'thana.district_id')
                    ->where('status', '1')
                    ->orderBy('schools_reg.id', 'desc')
                    ->select('schools_reg.*', 'thana.thana_name', 'district.district_name')
                    ->get();
        $index_content = view('admin.scl_list')
                ->with('scl_reqs', $scl_reqs);

        return view('admin.index')
                        ->with('page_content', $index_content);
    }


    public function scl_approve($id){
        $update = DB::table('schools_reg')
                    ->where('id', $id)
                    ->update(['status' => '1']);
        if($update){
            Session::put('message', 'Aproved!!!');
            return Redirect::to('/school_reg_req');
        }else{
            Session::put('error', 'School Not Approved!!!');
        }
    }


    public function scl_deactive($id){
        $update = DB::table('schools_reg')
                    ->where('id', $id)
                    ->update(['status' => '0']);
        if($update){
            Session::put('message', 'School deactived successfully!!!');
            return Redirect::to('/scl_list');
        }else{
            Session::put('error', 'School not deactived!!!');
        }
    }

    public function scl_delete($id){
        $delete = DB::table('schools_reg')
                    ->where('id', $id)
                    ->delete();
        if($delete){
            Session::put('message', 'School deleted successfully!!!');
            return Redirect::to('/school_reg_req');
        }else{
            Session::put('error', 'School not deleted successfully!!!');
        }
    }


    public function classes_list(){
        $classes = DB::table('class')->get();
        $classes_list = view('admin.classes_list')->with('classes', $classes);
        return view('admin.index')
            ->with('page_content', $classes_list);
    }

    public function class_create(Request $request){
        $validator = Validator::make($request->all(), [
                    'class_name' => 'unique:class,class_name',
                        ], [
                    'class_name.unique' => 'This class name already added.',
        ]);

        if ($validator->passes()):
            $class_name = $request->class_name;
            
            DB::table('class')->insert(['class_name' => $class_name]);
            
            return response()->json(['success' => '!!! Class name successfully added. !!!']);
        else:
            return response()->json(['errors' => $validator->errors()]);
        endif;
    }


    public function class_delete($id){
        $delete = DB::table('class')
                    ->where('id', $id)
                    ->delete();
        if($delete){
            Session::put('message', 'Class name deleted successfully!!!');
            return Redirect::to('/classes_list');
        }else{
            Session::put('error', 'Class name not deleted successfully!!!');
        }
    }


    public function class_edit($id){
        $class = DB::table('class')
                    ->where('id', $id)
                    ->get();
        $classes = DB::table('class')->get();
        $classes_list = view('admin.class_edit')
                    ->with('class', $class)
                    ->with('classes', $classes);
        return view('admin.index')
            ->with('page_content', $classes_list);
    }


    public function class_update(Request $request){
        $validator = Validator::make($request->all(), [
                    'class_name' => 'unique:class,class_name',
                        ], [
                    'class_name.unique' => 'This class name already added.',
        ]);

        if ($validator->passes()):
            $class_name = $request->class_name;
            $class_id = $request->class_id;
            
            DB::table('class')
            ->where('id', $class_id)
            ->update(['class_name' => $class_name]);
            
            return response()->json(['success' => '!!! Class name successfully added. !!!']);
        else:
            return response()->json(['errors' => $validator->errors()]);
        endif;
    }

    public function logoutSuper() {
        Session::put('SuperAdminName', null);
        Session::put('superAdminId', null);
        Session::put('message', 'You are successfully logout');
        return Redirect::to('/super/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}

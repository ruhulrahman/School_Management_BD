<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Validator;
use DB;
use Session;

session_start();

class AdminController extends Controller
{

    public function __construct() {
        $AdminId = Session::get('AdminId');
        $AdminName = Session::get('AdminName');
    }

    public function index() {
        $AdminId = Session::get('AdminId');
        if ($AdminId != Null) {
            return Redirect::to('/admin-dashboard/')->send();
        }
        return view('admin.login');
    }

    public function admin_dashboard() {
        $AdminId = Session::get('AdminId');
        if ($AdminId == Null) {
            return Redirect::to('/admin/')->send();
        }
        $adminAdmin = DB::table('schools_reg')->get();
        //$school_reg = DB::table('school_reg')->count();


        $index_content = view('admin.index_page_content');
        return view('admin.index')->with('page_content', $index_content);
    }

    public function AdminLogin(Request $request) {
        $scl_email = $request->scl_email;
        $password = md5($request->password);

        $scl_info = DB::table('schools_reg')
                        ->where('scl_email', $scl_email)
                        ->first();
        
        if(date('Y-m-d') < $scl_info->scl_expire_date){
            $adminQuery = DB::table('schools_reg')
                    ->where('scl_email', $scl_email)
                    ->where('scl_password', $password)
                    ->first();
            if ($adminQuery) {
                Session::put('AdminName', $adminQuery->scl_code);
                Session::put('AdminId', $adminQuery->id);

                return Redirect::to('/admin-dashboard/');
            } else {
                Session::put('message', 'User email and password not match!!');
                return Redirect::to('/admin/');
            }        
        }else{
            Session::put('message', 'School expire date over !!!');
            return Redirect::to('/admin/');
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

    public function view_class_routine(Request $request) {
        $class = "";
        if($request->class_id){
            $class = $request->class_id;
        }else{
            $class = 1;
        }

        $routine = DB::table('class_routine')
                    ->join('class_time', 'class_routine.time_id', '=', 'class_time.id')
                    ->where('class_routine.class_id', $class)
                    ->select('class_routine.*', 'class_time.time')
                    ->get();

        $index_content = view('admins.view_class_routine')
                ->with('routine', $routine);

        return view('admins.admins_dashboard')
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
                    ->update([
                        'status' => '1',
                        'scl_expire_date' => date('Y-m-d', strtotime("+30 days")),
                    ]);
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
        $AdminId = Session::get('AdminId');
        if ($AdminId == Null) {
            return Redirect::to('/admin/')->send();
        }else{
            $classes = DB::table('class')->get();
            $classes_list = view('admin.classes_list')->with('classes', $classes);
            return view('admin.index')
                ->with('page_content', $classes_list);
        }
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


    public function new_users()
    {
        $new_users = DB::table('users')
                    ->leftJoin('thana', 'thana.id', '=', 'users.thana_id')
                    ->rightJoin('district', 'district.id', '=', 'thana.district_id')
                    ->where('status','!=', '1')
                    ->orderBy('users.id', 'desc')
                    ->select('users.*', 'thana.thana_name', 'district.district_name')
                    ->get();

        $new_users_page = view('admin.new_users')->with('new_users', $new_users);
        return view('admin.index')->with('page_content', $new_users_page);
    }
    public function active_student()
    {
        $new_users = DB::table('users')
                    ->leftJoin('thana', 'thana.id', '=', 'users.thana_id')
                    ->rightJoin('district', 'district.id', '=', 'thana.district_id')
                    ->where('status','=', '1')
                    ->orderBy('users.id', 'desc')
                    ->select('users.*', 'thana.thana_name', 'district.district_name')
                    ->get();

        $new_users_page = view('admin.users')->with('new_users', $new_users);
        return view('admin.index')->with('page_content', $new_users_page);
    }

    public function user_active($id){
        $update = DB::table('users')
                    ->where('id', $id)
                    ->update(['status' => '1']);
        if($update){
            Session::put('message', 'User Activated!!!');
            return Redirect::to('/new_users');
        }else{
            Session::put('error', 'User Not Activated!!!');
        }
    }

    public function user_deactive($id){
        $update = DB::table('users')
                    ->where('id', $id)
                    ->update(['status' => '0']);
        if($update){
            Session::put('message', 'User Deactivated!!!');
            return Redirect::to('/active_users');
        }else{
            Session::put('error', 'User Not Deactivated!!!');
        }
    }

    public function user_delete($id){
        $delete = DB::table('users')
                    ->where('id', $id)
                    ->delete();
        if($delete){
            Session::put('message', 'User Deleted!!!');
            return Redirect::to('/new_users');
        }else{
            Session::put('error', 'User Not Deleted!!!');
        }
    }



    



    public function make_admin($id){

        $update = DB::table('users')
                ->where('id', $id)
                ->update(['power' => 'admin']);
        if($update){
            Session::put('message', 'Teahcer now made as a Admin!!');
            return Redirect::to('/view-active-tcr/'.Session::get('AdminName'));
        }else{
            Session::put('error', 'User Not Updated!!!');
        }
    }

    public function remove_admin($id){

        $update = DB::table('users')
                ->where('id', $id)
                ->update(['power' => 'Old admin']);
        if($update){
            Session::put('message', 'Admin Remove successfully!!!');
            return Redirect::to('/view-active-tcr/'.Session::get('AdminName'));
        }else{
            Session::put('error', 'User Not Updated!!!');
        }
    }

    public function admins_view(){
        $users = DB::table('users')->where('power', 'admin')->get();
        $index_content = view('admin.admins_view')
        ->with('users', $users);
        
        return view('admin.index')
        ->with('page_content', $index_content);
    }


    public function make_admin_from_admin($id){

        $update = DB::table('users')
                ->where('id', $id)
                ->update(['power' => 'admin']);
        if($update){
            Session::put('message', 'Teahcer now made as a Admin!!');
            return Redirect::to('/admins-view');
        }else{
            Session::put('error', 'User Not Updated!!!');
        }
    }


    public function remove_admin_from_admin($id){

        $update = DB::table('users')
                ->where('id', $id)
                ->update(['power' => '']);
        if($update){
            Session::put('message', 'Admin Remove successfully!!!');
            return Redirect::to('/admins-view');
        }else{
            Session::put('error', 'User Not Updated!!!');
        }
    }

    public function tcr_block($id){

        $update = DB::table('users')
                ->where('id', $id)
                ->update(['power' => 'block']);
        if($update){
            Session::put('message', 'Teahcer now blocked!!');
            return Redirect::to('/teachers');
        }else{
            Session::put('error', 'User Not Updated!!!');
        }
    }

    public function tcr_unblock($id){

        $update = DB::table('users')
                ->where('id', $id)
                ->update(['power' => '']);
        if($update){
            Session::put('message', 'Teahcer now unblocked!!');
            return Redirect::to('/teachers');
        }else{
            Session::put('error', 'User Not Updated!!!');
        }
    }

    public function tcr_delete($id){

        $update = DB::table('users')
                ->where('id', $id)
                ->delete();
        if($update){
            Session::put('message', 'Teahcer deleted successfully!!');
            return Redirect::to('/teachers');
        }else{
            Session::put('error', 'User Not deleted!!!');
        }
    }

    public function new_student_req($scl_code)
    {
        $new_student = DB::table('users')
                    ->leftJoin('thana', 'thana.id', '=', 'users.thana_id')
                    ->rightJoin('district', 'district.id', '=', 'thana.district_id')
                    ->where('status','!=', '1')
                    ->where('scl_code','=', $scl_code)
                    ->where('user_type','=', 'student')
                    ->orderBy('users.id', 'desc')
                    ->select('users.*', 'thana.thana_name', 'district.district_name')
                    ->get();

        $new_student_page = view('admin.new_student_req')->with('new_student_req', $new_student);
        return view('admin.index')->with('page_content', $new_student_page);
    }
    public function view_active_stn($scl_code)
    {
        $new_users = DB::table('users')
                    ->leftJoin('thana', 'thana.id', '=', 'users.thana_id')
                    ->rightJoin('district', 'district.id', '=', 'thana.district_id')
                    ->where('status','=', '1')
                    ->where('scl_code','=', $scl_code)
                    ->where('user_type','=', 'student')
                    ->orderBy('users.id', 'desc')
                    ->select('users.*', 'thana.thana_name', 'district.district_name')
                    ->get();

        $new_users_page = view('admin.active_student')->with('active_student', $new_users);
        return view('admin.index')->with('page_content', $new_users_page);
    }


    
    public function stn_activation($id)
    {
        $AdminName = Session::get('AdminName');
        $update = DB::table('users')
                    ->where('id', $id)
                    ->update(['status' => '1']);
        if($update){
            Session::put('message', 'Student Activated!!!');
            return Redirect::to('/new-stn-req/'.$AdminName);
        }else{
            Session::put('error', 'Student Not Activated!!!');
        }
    }


    public function stn_deactivation($id)
    {
        $AdminName = Session::get('AdminName');
        $update = DB::table('users')
                    ->where('id', $id)
                    ->update(['status' => '0']);
        if($update){
            Session::put('message', 'Student Deactivated!!!');
            return Redirect::to('view-active-stn/'.$AdminName);
        }else{
            Session::put('error', 'Student Not deactivated!!!');
        }
    }


    public function student_delete($id)
    {
        $AdminName = Session::get('AdminName');
        $update = DB::table('users')
                    ->where('id', $id)
                    ->delete();
        if($update){
            Session::put('message', 'Student Deleted!!!');
            if(url()->current() == base_path().'/view-active-stn/'.$AdminName){
                return Redirect::to('view-active-stn/'.$AdminName);
            }else{
                return Redirect::to('/new-stn-req/'.$AdminName);
            }
        }else{
            Session::put('error', 'Student Not Deleted!!!');
        }
    }


    //============Teacher Mananage Start from here=========================================
    //=====================================================================================

    public function new_tcr_req($scl_code)
    {
        $new_tcr = DB::table('users')
                    ->leftJoin('thana', 'thana.id', '=', 'users.thana_id')
                    ->rightJoin('district', 'district.id', '=', 'thana.district_id')
                    ->where('status','!=', '1')
                    ->where('scl_code','=', $scl_code)
                    ->where('user_type','=', 'teacher')
                    ->orderBy('users.id', 'desc')
                    ->select('users.*', 'thana.thana_name', 'district.district_name')
                    ->get();

        $new_tcr_page = view('admin.new_tcr_req')->with('new_tcr_req', $new_tcr);
        return view('admin.index')->with('page_content', $new_tcr_page);
    }
    public function view_active_tcr($scl_code)
    {
        $active_tcr = DB::table('users')
                    ->leftJoin('thana', 'thana.id', '=', 'users.thana_id')
                    ->rightJoin('district', 'district.id', '=', 'thana.district_id')
                    ->where('status','=', '1')
                    ->where('scl_code','=', $scl_code)
                    ->where('user_type','=', 'teacher')
                    ->orderBy('users.id', 'desc')
                    ->select('users.*', 'thana.thana_name', 'district.district_name')
                    ->get();

        $active_tcr_page = view('admin.active_tcr')->with('active_tcr', $active_tcr);
        return view('admin.index')->with('page_content', $active_tcr_page);
    }


    
    public function tcr_activation($id)
    {
        $AdminName = Session::get('AdminName');
        $update = DB::table('users')
                    ->where('id', $id)
                    ->update(['status' => '1']);
        if($update){
            Session::put('message', 'Teacher Activated!!!');
            return Redirect::to('/new-tcr-req/'.$AdminName);
        }else{
            Session::put('error', 'Teacher Not Activated!!!');
        }
    }


    public function tcr_deactivation($id)
    {
        $AdminName = Session::get('AdminName');
        $update = DB::table('users')
                    ->where('id', $id)
                    ->update(['status' => '0']);
        if($update){
            Session::put('message', 'Teacher Deactivated!!!');
            return Redirect::to('view-active-tcr/'.$AdminName);
        }else{
            Session::put('error', 'Teacher Not deactivated!!!');
        }
    }


    public function teacher_delete($id)
    {
        $AdminName = Session::get('AdminName');
        $update = DB::table('users')
                    ->where('id', $id)
                    ->delete();
        if($update){
            Session::put('message', 'Teacher Deleted!!!');
            if(url()->current() == base_path().'/view-active-tcr/'.$AdminName){
                return Redirect::to('view-active-tcr/'.$AdminName);
            }else{
                return Redirect::to('/new-stn-req/'.$AdminName);
            }
        }else{
            Session::put('error', 'Teacher Not Deleted!!!');
        }
    }


    public function class_routine_add()
    {
        $days = DB::table('days')                    
                    ->orderBy('id', 'asc')
                    ->get();
        $index_content = view('admin.add_class_routine')
                ->with('Days', $days);

        return view('admin.index')
                        ->with('page_content', $index_content); 
    }


    public function create_class_routine(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'class_id' => 'required',
                    'time_id' => 'required',
                    'saturday' => 'required',
                    'sunday' => 'required',
                    'monday' => 'required',
                    'tuesday' => 'required',
                    'wednesday' => 'required',
                    'thursday' => 'required',
                        ], [
                    'class_id.required' => 'You can\'t leave this empty.',
                    'time_id.required' => 'You can\'t leave this empty.',
                    'saturday.required' => 'You can\'t leave this empty.',
                    'sunday.required' => 'You can\'t leave this empty.',
                    'monday.required' => 'You can\'t leave this empty.',
                    'tuesday.required' => 'You can\'t leave this empty.',
                    'wednesday.required' => 'You can\'t leave this empty.',
                    'thursday.required' => 'You can\'t leave this empty.',
        ]);

        if ($validator->passes()):
        $data = array();
        $data['scl_code'] = Session::get('SCL_code');
        $data['class_id'] = $request->class_id;
        $data['time_id'] = $request->time_id;
        $data['saturday'] = $request->saturday;
        $data['sunday'] = $request->sunday;
        $data['monday'] = $request->monday;
        $data['tuesday'] = $request->tuesday;
        $data['wednesday'] = $request->wednesday;
        $data['thursday'] = $request->thursday;
            
            DB::table('class_routine')->insert($data);
            
            return response()->json(['success' => '!!! Class Routine successfully added. !!!']);
        else:
            return response()->json(['errors' => $validator->errors()]);
        endif;
    }


    public function subject_add()
    {
        $subjects = DB::table('subject')->orderBy('subject_name_en', 'asc')->get();
        $add_subjects = view('admin.subject_add')->with('subjects', $subjects);
        return view('admin.index')->with('page_content', $add_subjects);
    }

    public function subject_create(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'subject_name_en' => 'required|unique:subject,subject_name_en',
                    'subject_name_bn' => 'required|unique:subject,subject_name_bn',
                        ], [
                    'subject_name_en.required' => 'You can\'t leave this empty.',
                    'subject_name_en.unique' => 'This subject name already added.',
                    'subject_name_bn.required' => 'You can\'t leave this empty.',
                    'subject_name_bn.unique' => 'This subject name already added.',
        ]);

        if ($validator->passes()):
            $data = array();
            $data['subject_name_en'] = $request->subject_name_en;
            $data['subject_name_bn'] = $request->subject_name_bn;
            
            DB::table('subject')->insert($data);
            
            return response()->json(['success' => '!!! Subject successfully added. !!!']);
        else:
            return response()->json(['errors' => $validator->errors()]);
        endif;
    }

    public function subject_edit($id)
    {
        $subject_by_id = DB::table('subject')
                    ->where('id', $id)
                    ->get();
        $subject_all = DB::table('subject')->get();
        $subject_edit = view('admin.subject_edit')
                    ->with('subjects', $subject_all)
                    ->with('subject', $subject_by_id);
        return view('admin.index')
            ->with('page_content', $subject_edit);
    }

    public function subject_update(Request $request)
    {

        $validator = Validator::make($request->all(), [
                    'subject_name_en' => 'required',
                    'subject_name_bn' => 'required',
                        ], [
                    'subject_name_en.required' => 'You can\'t leave this empty.',
                    'subject_name_bn.required' => 'You can\'t leave this empty.',
        ]);

        if ($validator->passes()):
            $data = array();
            $id = $request->id;
            $data['subject_name_en'] = $request->subject_name_en;
            $data['subject_name_bn'] = $request->subject_name_bn;
            
            DB::table('subject')->where('id', $id)->update($data);
            
            return response()->json(['success' => '!!! Subject successfully updated. !!!']);
        else:
            return response()->json(['errors' => $validator->errors()]);
        endif;
    }

    public function subject_delete($id)
    {
        $delete = DB::table('subject')
                    ->where('id', $id)
                    ->delete();
        if($delete){
            Session::put('message', 'Subject Deleted!!!');
            return Redirect::to('/subject_add_page');
        }else{
            Session::put('error', 'Subject Not Deleted!!!');
        }
    }

    public function logoutAdmin() {
        Session::put('scl_code', null);
        Session::put('AdminId', null);
        Session::put('message', 'You are successfully logout');
        return Redirect::to('/admin');
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

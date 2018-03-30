<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();



//Admin Controller==========================================================
Route::get('/admin/', 'AdminController@index');
Route::get('/admin-dashboard/', 'AdminController@admin_dashboard');
Route::get('/logout-admin', 'AdminController@logoutAdmin');

Route::post('/admin-login/', 'AdminController@AdminLogin');


Route::middleware('admin')->group(function(){
	Route::get('/class-routine', 'AdminController@class_routine');

	Route::get('/new-stn-req/{id}', 'AdminController@new_student_req');
	Route::get('/view-active-stn/{id}', 'AdminController@view_active_stn');
	Route::get('/stn-activation/{id}', 'AdminController@stn_activation');
	Route::get('/stn-deactivation/{id}', 'AdminController@stn_deactivation');
	Route::get('/student_delete/{id}', 'AdminController@student_delete');

	Route::get('/new-tcr-req/{id}', 'AdminController@new_tcr_req');
	Route::get('/view-active-tcr/{id}', 'AdminController@view_active_tcr');
	Route::get('/tcr-activation/{id}', 'AdminController@tcr_activation');
	Route::get('/tcr-deactivation/{id}', 'AdminController@tcr_deactivation');	
	Route::get('/tcr-delete/{id}', 'AdminController@tcr_delete');
	Route::get('/make-admin/{id}', 'AdminController@make_admin');
	Route::get('/remove-admin/{id}', 'AdminController@remove_admin');
	Route::get('/tcr-block/{id}', 'AdminController@tcr_block');
	Route::get('/tcr-unblock/{id}', 'AdminController@tcr_unblock');
	Route::get('/teachers', 'AdminController@teachers');
	Route::get('/admins-view', 'AdminController@admins_view');
	Route::get('/make-admin-from-admin/{id}', 'AdminController@make_admin_from_admin');
	Route::get('/remove-admin-from-admin/{id}', 'AdminController@remove_admin_from_admin');
});
//===============================================================================



//Super Admin Controller==========================================================
Route::get('/super/', 'SuperAdminController@index');
Route::get('/super-dashboard/', 'SuperAdminController@super_dashboard');
Route::get('/logout-super', 'SuperAdminController@logoutSuper');

Route::post('/super-admin-login/', 'SuperAdminController@superAdminLogin');



Route::middleware('superadmin')->group(function(){
	//Super Admin Controller==========================================================
	Route::get('/location', 'SuperAdminController@location');
	Route::get('/school_reg_req', 'SuperAdminController@school_reg_req');
	Route::get('/scl_approve/{id}', 'SuperAdminController@scl_approve');
	Route::get('/scl_delete/{id}', 'SuperAdminController@scl_delete');
	Route::get('/scl_deactive/{id}', 'SuperAdminController@scl_deactive');
	Route::get('/classes_list', 'SuperAdminController@classes_list');
	Route::get('/class_delete/{id}', 'SuperAdminController@class_delete');
	Route::get('/class_edit/{id}', 'SuperAdminController@class_edit');
	Route::get('/scl_list', 'SuperAdminController@scl_list');
	Route::get('/new_users', 'SuperAdminController@new_users');
	Route::get('/user_active/{id}', 'SuperAdminController@user_active');		
	Route::get('/active_users', 'SuperAdminController@active_users');
	Route::get('/user_deactive/{id}', 'SuperAdminController@user_deactive');
	Route::get('/user_delete/{id}', 'SuperAdminController@user_delete');
	Route::get('/features_add_page', 'SuperAdminController@features_add_page');
	Route::get('/feature_delete/{id}', 'SuperAdminController@feature_delete');
	Route::get('/feature_edit/{id}', 'SuperAdminController@feature_edit');




	Route::post('/country-create', 'SuperAdminController@country_create');
	Route::post('/division-create', 'SuperAdminController@division_create');
	Route::post('/district-create', 'SuperAdminController@district_create');
	Route::post('/thana-create', 'SuperAdminController@thana_create');
	Route::post('/class-create', 'SuperAdminController@class_create');
	Route::post('/class-update', 'SuperAdminController@class_update');
	Route::post('/features-create', 'SuperAdminController@features_create');
	Route::post('/feature_update', 'SuperAdminController@feature_update');

	Route::post('/select-ajax', ['as'=>'select-ajax','uses'=>'SuperAdminController@selectAjax']);

});

	//for create location
	Route::get('/division/{id}', 'SuperAdminController@division');
	Route::get('/district/{id}', 'SuperAdminController@district');
	Route::get('/thana/{id}', 'SuperAdminController@thana');

//School Controller Here =========================================================
Route::get('/', 'SchoolController@index');
Route::get('/features', 'SchoolController@features');
Route::get('/school_reg', 'SchoolController@school_reg');
Route::get('/registration', 'SchoolController@registration');
//Route::get('/login', 'SchoolController@login');

Route::post('/scl-registration-submit', 'SchoolController@scl_registration_submit');







//User Controller Here==================================================
//Route::get('/user_reg', 'HomeController@user_reg')->name('home');

Route::post('/user_registration', 'UserController@user_registration');
Route::post('/user_registration_teacher', 'UserController@user_registration_teacher');




Route::get('/home', 'HomeController@index')->name('home');
Route::get('/log', 'HomeController@log');





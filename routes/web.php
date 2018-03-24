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


//Super Admin Controller==========================================================
Route::get('/super/', 'SuperAdminController@index');
Route::get('/super-dashboard/', 'SuperAdminController@super_dashboard');
Route::get('/logout-super', 'SuperAdminController@logoutSuper');
Route::get('/location', 'SuperAdminController@location');
Route::get('/class-routine', 'SuperAdminController@class_routine');
Route::get('/school_reg_req', 'SuperAdminController@school_reg_req');
Route::get('/scl_list', 'SuperAdminController@scl_list');
Route::get('/scl_approve/{id}', 'SuperAdminController@scl_approve');
Route::get('/scl_delete/{id}', 'SuperAdminController@scl_delete');
Route::get('/scl_deactive/{id}', 'SuperAdminController@scl_deactive');
Route::get('/classes_list', 'SuperAdminController@classes_list');
Route::get('/class_delete/{id}', 'SuperAdminController@class_delete');
Route::get('/class_edit/{id}', 'SuperAdminController@class_edit');

Route::post('/super-admin-login/', 'SuperAdminController@superAdminLogin');
Route::post('/country-create', 'SuperAdminController@country_create');
Route::post('/division-create', 'SuperAdminController@division_create');
Route::post('/district-create', 'SuperAdminController@district_create');
Route::post('/thana-create', 'SuperAdminController@thana_create');
Route::post('/class-create', 'SuperAdminController@class_create');
Route::post('/class-update', 'SuperAdminController@class_update');

Route::post('/select-ajax', ['as'=>'select-ajax','uses'=>'SuperAdminController@selectAjax']);
///===============================================================================


Route::middleware('auth')->group(function(){
	
});



//School Controller Here =========================================================
Route::get('/', 'SchoolController@index');
Route::get('/features', 'SchoolController@features');
Route::get('/school_reg', 'SchoolController@school_reg');
Route::get('/registration', 'SchoolController@registration');
Route::get('/teachers', 'SchoolController@teachers');
//Route::get('/login', 'SchoolController@login');

Route::post('/scl-registration-submit', 'SchoolController@scl_registration_submit');







//User Controller Here==================================================
//Route::get('/user_reg', 'HomeController@user_reg')->name('home');

Route::post('/user_registration', 'UserController@user_registration');
Route::post('/user_registration_teacher', 'UserController@user_registration_teacher');




Route::get('/home', 'HomeController@index')->name('home');
Route::get('/log', 'HomeController@log');

//for create location
Route::get('/division/{id}', 'SuperAdminController@division');
Route::get('/district/{id}', 'SuperAdminController@district');
Route::get('/thana/{id}', 'SuperAdminController@thana');



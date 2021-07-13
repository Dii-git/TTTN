<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Models\User;
use App\Http\Middleware\AdminLoginMiddleware;
use App\Jobs\SendMail;
use Illuminate\Support\Facades\Auth;

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
//User///////////////////////////////////////////////////////////////////////////
	//Register
	Route::get('register', 'Auth\RegisterController@getRegister');
	Route::post('register', 'Auth\RegisterController@postRegister');
 
	//Login
	Route::get('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
	Route::post('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@postLogin']);
 
	//Log Out
	Route::get('logout', function(){
		Auth::logout();
		return redirect('login');
	});


	Route::group(['middleware' => 'role:user'], function() {

		Route::get('/user', function() {
	
		return 'Welcome Admin';
	
		});
	
	});

	Route::get('/profile', [App\Http\Controllers\User\ProfileController::class, 'getUserprofile']);
	Route::post('/profile', [App\Http\Controllers\User\ProfileController::class, 'postUserprofile']);

	//Update
	Route::post('/update_profile', [App\Http\Controllers\User\ProfileController::class, 'updateUser']);

	Auth::routes();
//Admin//////////////////////////////////////////////////////////////////////////////
	
	Route::get('admin',[App\Http\Controllers\Admin\AdminController::class, 'listAdmin'])
	->middleware('adminLogin');
	//User
	Route::get('list_users',[App\Http\Controllers\Admin\AdminController::class, 'listUser']);
	Route::post('/delete_user/{id}',[App\Http\Controllers\Admin\AdminController::class, 'deleteUser']);

	//Email
	Route::post('/sendmail/{id}', [App\Http\Controllers\Admin\EmailController::class, 'sendMailUser']);
	Route::post('/add-email-queue', [App\Http\Controllers\Admin\EmailController::class, 'addEmailQueue']);
	Route::get('list_email',[App\Http\Controllers\Admin\EmailController::class, 'listEmail']);
	Route::post('/send-email-queue', [App\Http\Controllers\Admin\EmailController::class, 'sendQueue']);
	

	//Send mail to queue
	// Route::get('email-test', function(){

	// 	$details['email'] = Auth::user()->email;
		
	// 	dispatch(new App\Jobs\SendMail($details));
		
	// 	return view('admin\admin');
	// 	});


	Route::get('email-test', function(){
  
		$details['email'] = Auth::user()->email;
	  
		dispatch(new App\Jobs\SendEmailJob($details));
	  
		dd('Send Email Successfully');
	});

	//Post
	Route::get('list_post',[App\Http\Controllers\Admin\PostAdminController::class, 'listPost']);
	Route::post('/delete_post/{id}',[App\Http\Controllers\Admin\PostAdminController::class, 'deletePost']);

	Route::get('/enabled_post/{id}',[App\Http\Controllers\Admin\PostAdminController::class, 'enabledPost']);
	Route::get('/unenabled_post/{id}',[App\Http\Controllers\Admin\PostAdminController::class, 'unenabledPost']);

	//Voucher
	Route::get('add_voucher',[App\Http\Controllers\Admin\VoucherAdminController::class, 'addVoucher']);
	Route::get('list_voucher',[App\Http\Controllers\Admin\VoucherAdminController::class, 'listVoucher']);
	Route::post('save_voucher',[App\Http\Controllers\Admin\VoucherAdminController::class, 'saveVoucher']);

	Route::get('/enabled_voucher/{id}',[App\Http\Controllers\Admin\VoucherAdminController::class, 'enabledVou']);
	Route::get('/unenabled_voucher/{id}',[App\Http\Controllers\Admin\VoucherAdminController::class, 'unenabledVou']);

	Route::post('/delete_voucher/{id}',[App\Http\Controllers\Admin\VoucherAdminController::class, 'deleteVou']);

	Route::get('list_voucher_issue',[App\Http\Controllers\Admin\VoucherAdminController::class, 'listVoucherIssue']);

//FrontEnd///////////////////////////////////////////////////////////////////////////
	Route::get('/roles', [App\Http\Controllers\PermissionController::class, 'Permission']);
	Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

	Route::post('create_post', [App\Http\Controllers\User\PostController::class, 'createPost']);
	Route::get('/edit_post/{id}',[App\Http\Controllers\User\PostController::class, 'getEdit']);
	Route::post('/update_post',[App\Http\Controllers\User\PostController::class, 'updatePost']);
	Route::get('/delete_post/{id}',[App\Http\Controllers\User\PostController::class, 'deletePost']);
	Route::get('/detail/{id}',[App\Http\Controllers\User\PostController::class, 'detail']);
	Route::get('/postUser',[App\Http\Controllers\User\PostController::class, 'allPostUser']);


	Route::post('create_voucher', [App\Http\Controllers\User\VoucherController::class, 'createVoucher']);
	

//Mail///////////////////////////////////////////////////////////////////////////////
	Route::get('mail', [App\Http\Controllers\MailController::class, 'sendMailUser']);

//BackEnd///////////////////////////////////////////////////////////////////////////
	//Category
	Route::get('add_cate',[App\Http\Controllers\Admin\CategoryAdminController::class, 'addCate']);
	Route::get('list_cate',[App\Http\Controllers\Admin\CategoryAdminController::class, 'listCate']);
	
	Route::post('save_cate',[App\Http\Controllers\Admin\CategoryAdminController::class, 'saveCate']);
	Route::get('edit_cate/{id}',[App\Http\Controllers\Admin\CategoryAdminController::class, 'editCate']);
	Route::post('save_edit_cate',[App\Http\Controllers\Admin\CategoryAdminController::class, 'saveEditCate']);
	Route::post('/delete_cate/{id}',[App\Http\Controllers\Admin\CategoryAdminController::class, 'deleteCate']);
	
	Route::get('/active_cate/{id}',[App\Http\Controllers\Admin\CategoryAdminController::class, 'activeCate']);
	Route::get('/unactive_cate/{id}',[App\Http\Controllers\Admin\CategoryAdminController::class, 'unactiveCate']);

//Vue///////////////////////////////////////////////////////////////////////////////
	Route::get('vue-post',[App\Http\Controllers\Vue\VueController::class, 'vue']);

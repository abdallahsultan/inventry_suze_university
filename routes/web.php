<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AdminProductController;

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

Route::get('/', function () {
	return view('auth.login');
});

Auth::routes();

Route::post('/search', 'HomeController@search')->name('search');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('dashboard', function () {
	return view('layouts.master');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('faculties', 'FacultyController');
	Route::get('/apiFaculties', 'FacultyController@apiFaculties')->name('api.faculties');
	Route::get('/exportFacultiesAll', 'FacultyController@exportFacultiesAll')->name('exportPDF.facultiesAll');
	Route::get('/exportFacultiesAllExcel', 'FacultyController@exportExcel')->name('exportExcel.facultiesAll');

	Route::resource('categories', 'CategoryController');
	Route::get('/apiCategories', 'CategoryController@apiCategories')->name('api.categories');
	Route::get('/exportCategoriesAll', 'CategoryController@exportCategoriesAll')->name('exportPDF.categoriesAll');
	Route::get('/exportCategoriesAllExcel', 'CategoryController@exportExcel')->name('exportExcel.categoriesAll');
	
	Route::resource('units', 'UnitController');
	Route::get('/apiUnits', 'UnitController@apiUnits')->name('api.units');
	Route::get('/exportUnitsAll', 'UnitController@exportUnitsAll')->name('exportPDF.unitsAll');
	Route::get('/exportUnitsAllExcel', 'UnitController@exportExcel')->name('exportExcel.unitsAll');


	Route::resource('faculties_products', 'Admin\AdminProductController');
	Route::get('/apiFaculties_products/{id}', 'Admin\AdminProductController@details')->name('api.faculties_productdetials');
	Route::get('/apiFacultiesProducts', 'Admin\AdminProductController@apiProducts')->name('api.faculties_products');
	Route::resource('products', 'ProductController');
	Route::get('/apiProducts', 'ProductController@apiProducts')->name('api.products');

	Route::get('/products_inquiries', 'ProductController@inquiries')->name('products.inquiries');
	Route::get('/apiFaculties_products_inquiries/{id}', 'ProductController@details')->name('api.faculties_productdetials_inquiries');
	Route::get('/apiFacultiesproducts_inquiries', 'ProductController@apiProductsinquiries')->name('api.faculties_products_inquiries');
	
	Route::resource('depreciations', 'DepreciationController');
	Route::get('/apiDepreciations', 'DepreciationController@apiDepreciations')->name('api.depreciations');
	Route::get('/exportDepreciationsAll', 'DepreciationController@exportExcel')->name('exportExcel.depreciationsAll');
	Route::get('/exportDepreciationsAllExcel', 'DepreciationController@exportDepreciationsAll')->name('exportPDF.DepreciationsAll');

	Route::resource('requests', 'RequestController');
	Route::get('/ReceivedRequests', 'RequestController@index_received')->name('requests.index_received');
	Route::get('/apiRequests', 'RequestController@apiRequests')->name('api.requests');
	Route::get('/apiReceivedRequests', 'RequestController@apiReceivedRequests')->name('api.received_requests');
	Route::get('/exportRequestsAll', 'RequestController@exportRequestsAll')->name('exportPDF.requestsAll');
	Route::get('/exportRequestsAllExcel', 'RequestController@exportExcel')->name('exportExcel.requestsAll');

	Route::post('/requests/reciver/cancel', 'RequestController@cancel_request_reciver')->name('requests.cancel_reciver');
	Route::post('/requests/reciver/confirm', 'RequestController@confirm_request_reciver')->name('requests.confirm_reciver');
	Route::post('/requests/senter/cancel', 'RequestController@cancel_request_senter')->name('requests.cancel_senter');

	
	Route::resource('user', 'UserController');
	

	Route::get('/apiUser', 'UserController@apiUsers')->name('api.users');
	Route::get('/editprofile', 'UserController@editprofile')->name('edit.profile');
	Route::post('/update_profile', 'UserController@update_profile')->name('update.profile');
	Route::post('/settings', 'HomeController@setting')->name('settings');
});

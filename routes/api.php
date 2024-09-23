<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1'], function (){
	//Route::resource('users', UserController::class);
	//Route::resource('products', ProductController::class);

	Route::group(['prefix' => 'users'], function (){
		Route::post('orders', [\App\Http\Controllers\UserController::class, "order"]);
		Route::post('order_list', [\App\Http\Controllers\OrderController::class, "list"]);
		Route::post('all_product', [\App\Http\Controllers\OrderController::class, "allProduct"]);
		Route::post('all_user_product', [\App\Http\Controllers\OrderController::class, "allProductUser"]);
		Route::post('create', [\App\Http\Controllers\UserController::class, "create"]);
		Route::get('', [\App\Http\Controllers\UserController::class, "index"]);
	});

	Route::group(['prefix' => 'products'], function (){
		Route::post('delete', [\App\Http\Controllers\ProductController::class, "destroy"]);
		Route::post('update', [\App\Http\Controllers\ProductController::class, "update"]);
		Route::post('create', [\App\Http\Controllers\ProductController::class, "create"]);
		Route::post('find', [\App\Http\Controllers\ProductController::class, "show"]);
		Route::get('', [\App\Http\Controllers\ProductController::class, "index"]);
	});

});

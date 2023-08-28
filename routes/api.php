<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MealController;
use App\Http\Controllers\User\UserAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Customer API Routes
|--------------------------------------------------------------------------
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
    'controller' => UserAuthController::class
], function ($router) {

    Route::post('login', 'login')->name('user.login');
    Route::post('logout', 'logout')->name('user.logout');
    Route::post('refresh', 'refresh')->name('user.refresh');
    Route::post('me', 'me')->name('user.currentUser');
});




/*
|--------------------------------------------------------------------------
| API Admin Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'middleware' => 'admin-api',
    'prefix' => 'admin-auth',
    'controller' => AdminAuthController::class
], function ($router) {

    Route::post('login', 'login')->name('admin.login');
    Route::post('logout', 'logout')->name('admin.logout');
    Route::post('refresh', 'refresh')->name('admin.refresh');
    Route::post('me', 'me')->name('admin.currentUser');
});


Route::group([
    'prefix' => 'admin-category',
    'controller' => CategoryController::class,
    'middleware' => 'auth:admin-api'
], function () {
   Route::get('all', 'index')->name('admin.category.all');
   Route::post('store', 'store')->name('admin.category.store');
   Route::get('show/{id}', 'show')->name('admin.category.store');
   Route::put('update/{id}', 'update')->name('admin.category.update');
   Route::delete('delete/{id}', 'destroy')->name('admin.category.delete');
   Route::post('updateImg/{id}', 'updateCategoryImg')->name('admin.category.updateImage');
});

Route::group([
    'prefix' => 'admin-meal',
    'controller' => MealController::class,
    'middleware' => 'auth:admin-api'
], function () {
   Route::get('all', 'index')->name('admin.meal.all');
   Route::post('store', 'store')->name('admin.meal.store');
   Route::get('show/{id}', 'show')->name('admin.meal.store');
   Route::put('update/{id}', 'update')->name('admin.meal.update');
   Route::delete('delete/{id}', 'destroy')->name('admin.meal.delete');
});




//----------   Route Error Handling ------------------
Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@burgerStore.com'], 404);
});

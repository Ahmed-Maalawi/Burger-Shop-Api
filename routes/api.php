<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MealImageController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\Admin\MealController;
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


/*
|-----------------------
| Admin Auth Routes
|-----------------------
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



/*
|-----------------------
| Admin Category CRUD Routes
|-----------------------
*/
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

/*
|-----------------------
| Admin Meal CRUD Routes
|-----------------------
*/
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

/*
|-----------------------
| Admin Meal Images CRUD Routes
|-----------------------
*/
Route::group([
    'prefix' => 'admin-mealImg',
    'controller' => MealImageController::class,
    'middleware' => 'auth:admin-api'
], function () {
    Route::get('all', 'index')->name('admin.mealImg.all');
    Route::post('store', 'store')->name('admin.mealImg.store');
    Route::get('show/{id}', 'show')->name('admin.mealImg.store');
    Route::patch('update/{id}', 'update')->name('admin.mealImg.update');
    Route::delete('delete/{id}', 'destroy')->name('admin.mealImg.delete');
});



/*
|-----------------------
| Admin Slider CRUD Routes
|-----------------------
*/
Route::group([
    'prefix' => 'admin-slider',
    'controller' => SliderController::class,
    'middleware' => 'auth:admin-api'
], function () {
    Route::get('all', 'index')->name('admin.slider.all');
    Route::post('store', 'store')->name('admin.slider.store');
    Route::get('show/{id}', 'show')->name('admin.slider.store');
    Route::patch('update/{id}', 'update')->name('admin.slider.update');
    Route::post('update-img/{id}', 'updateImage')->name('admin.slider.updateImg');
    Route::delete('delete/{id}', 'destroy')->name('admin.slider.delete');
});

//----------   Route Error Handling ------------------
Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@burgerStore.com'], 404);
});

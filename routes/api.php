<?php

use App\Http\Controllers\Admin\AdminAuthController;
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

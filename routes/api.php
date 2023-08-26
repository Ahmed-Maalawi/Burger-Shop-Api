<?php

use App\Http\Controllers\User\UserAuthController as UserAuthControllerAlias;
use Illuminate\Http\Request;
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
    'controller' => UserAuthControllerAlias::class
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



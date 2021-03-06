<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);

Route::post('verify-recaptcha', [App\Http\Controllers\ThirdParties\ReCaptchaController::class, 'verifyReCaptcha']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('logout', [App\Http\Controllers\Auth\LogoutController::class, 'logout']);

    Route::get('customers', [App\Http\Controllers\Customers\CustomerController::class, 'getCustomers']);
    Route::get('customers/average-registered', [App\Http\Controllers\Customers\CustomerController::class, 'getAverageRegistration']);
});

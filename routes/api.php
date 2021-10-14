<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['namespace' => 'Api' , 'prefix' => 'v1'], function() {

    Route::post('/login',[App\Http\Controllers\Api\AuthController::class, 'login']);


    Route::group(['prefix' => 'company'], function() {


        Route::get('/company', [App\Http\Controllers\Api\CompanyController::class,'index']);
        Route::get('/company/{id}', [App\Http\Controllers\Api\CompanyController::class,'show']);
        Route::post('/company', [App\Http\Controllers\Api\CompanyController::class,'store']);
        Route::put('/company/{id}', [App\Http\Controllers\Api\CompanyController::class,'update']);
        Route::delete('/company/{id}', [App\Http\Controllers\Api\CompanyController::class,'destroy']);


    });

    Route::group(['prefix' => 'employee'], function() {

        Route::get('/employee',[App\Http\Controllers\Api\EmployeeController::class,'index']);
        Route::get('/employee/{id}',[App\Http\Controllers\Api\EmployeeController::class,'show']);
        Route::post('/employee',[App\Http\Controllers\Api\EmployeeController::class,'store']);
        Route::put('/employee/{id}',[App\Http\Controllers\Api\EmployeeController::class,'update']);
        Route::delete('/employee/{id}',[App\Http\Controllers\Api\EmployeeController::class,'destroy']);


    });




});



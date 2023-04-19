<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MonitorController;
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

//User
Route::post('register', [AuthController::class, "register"]);
Route::post('login', [AuthController::class, "login"]);
Route::post('updateData', [UserController::class, "updateData"]);
//Route::post('changeFullName', [UserController::class, "changeFullName"]);
Route::post('deleteUser/{id}', [UserController::class, "deleteUser"]);

Route::get('showUsers', [UserController::class, "showAll"]);
Route::get('userName/{name}', [UserController::class, "findName"]);
Route::get('user/{id}', [UserController::class, "showId"]);

//Monitor
Route::post('registerMonitor', [MonitorController::class, "addMonitorInfo"]);//create
Route::post('updateMonitor', [MonitorController::class, "changeImg"]);//update
Route::post('deleteMonitor', [MonitorController::class, "deleteMonitor"]);//delete
Route::get('monitores/{id}', [MonitorController::class, "mostrarImagen"]);//read
Route::get('monitores', [MonitorController::class, "showAll"]);//read

//Other
Route::get('products', [ProductController::class, "index"]);




Route::middleware('auth:sanctum')->group( function() {
    Route::get('logout', [AuthController::class, "logout"]);
    Route::get('userToken', [UserController::class, "showToken"]);

});

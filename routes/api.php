<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\ProductController;
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

//Auth
Route::post('register', [AuthController::class, "register"]);
Route::post('login', [AuthController::class, "login"]);

//Monitor
Route::post('registerMonitor', [MonitorController::class, "addMonitorInfo"]);
Route::post('updateMonitor', [MonitorController::class, "changeImg"]);
Route::post('deleteMonitor', [MonitorController::class, "deleteMonitor"]);
Route::get('monitores/{id}', [MonitorController::class, "mostrarImagen"]);
Route::get('monitores', [MonitorController::class, "showAll"]);

//other
Route::get('products', [ProductController::class, "index"]);




Route::middleware('auth:sanctum')->group( function() {
    Route::get('logout', [AuthController::class, "logout"]);
});

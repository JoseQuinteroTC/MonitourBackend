<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\MonitoriasController;
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
Route::post('updatePassword', [UserController::class, "changePassword"]);
//Route::post('changeFullName', [UserController::class, "changeFullName"]);
Route::post('deleteUser/{id}', [UserController::class, "deleteUser"]);

Route::get('showUsers', [UserController::class, "showAll"]);
Route::get('userName/{name}', [UserController::class, "findName"]);
Route::get('user/{id}', [UserController::class, "showId"]);
Route::get('userToken/{token}', [UserController::class, "showToken"]);

//Monitor
Route::post('registerMonitor', [MonitorController::class, "addMonitorInfo"]);//create
Route::post('updateMonitor', [MonitorController::class, "changeImg"]);//update
Route::post('deleteMonitor', [MonitorController::class, "deleteMonitor"]);//delete
Route::get('monitores', [MonitorController::class, "showAll"]);//read


//Monitorias
Route::get('monitorias', [MonitoriasController::class, "showAll"]);//read
Route::get('qr/{id}', [MonitoriasController::class, "qr"]);//read
Route::get('name/{name}', [MonitoriasController::class, "findName"]);//read
Route::get('monitorias/{id}', [MonitoriasController::class, "findMonitoria"]);//read
Route::get('monitorias/monitor/{id}', [MonitoriasController::class, "findMonitoriaByMonitor"]);//read

Route::get('monitoriasName/{course}', [MonitoriasController::class, "findMonitoriasName"]);//read
Route::get('monitoriasRecomendadas/{course}', [MonitoriasController::class, "MonitoriasRelated"]);//read

Route::get('monitorias/recomendadas/{course}', [MonitoriasController::class, "findMonitoriaByCourse"]);//read
Route::post('registerMonitoria', [MonitoriasController::class, "addMonitoriaInfo"]);//read
Route::post('modificarMonitoria', [MonitoriasController::class, "updateData"]);//read
Route::post('deleteMonitoria/{id}', [MonitoriasController::class, "delete"]);//read



Route::post('img', [UserController::class, "saveImg"]);//read


Route::get('email/{nombre}', [UserController::class, "sendResetLinkEmail"]);//read

Route::post('reset', [UserController::class, "validatePin"]);//read

Route::post('resetPassword', [UserController::class, "resetPassword"]);//read





//Other
Route::get('products', [ProductController::class, "index"]);




Route::middleware('auth:sanctum')->group( function() {
    Route::get('logout', [AuthController::class, "logout"]);
});

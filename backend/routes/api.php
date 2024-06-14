<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Role
Route::post('/createrole',[RoleController::class, 'CreateRole']);
Route::get('/allrole',[RoleController::class, 'AllRole']);
Route::get('/getrole/{id}',[RoleController::class, 'GetRole']);
Route::post('/updaterole',[RoleController::class, 'UpdateRole']);
Route::post('/deleterole',[RoleController::class, 'DeleteRole']);

//Jobs
Route::post('/createjobs',[JobController::class ,'CreateJob']);
Route::get('alljob',[JobController::class, 'AllJobs']);
Route::get('/getjob/{id}',[JobController::class, 'GetJob']);
Route::post('/updatejob',[JobController::class, 'UpdateJob']);
Route::post('/deletejob',[JobController::class, 'DeleteJob']);

//User
Route::post('/createuser',[UserController::class , 'CreateUser']);
Route::get('/alluser', [UserController::class, 'AllUser']);
Route::get('/getuser/{id}',[UserController::class, 'GetUser']);
Route::post('/updateuser', [UserController::class, 'UpdateUser']);
Route::post('/deleteuser', [UserController::class, 'DeleteUser']);
Route::post('/login',[UserController::class, 'Login']);
Route::get('/authUserVerify',[UserController::class, 'authUserVerify']);
Route::get('/currentuser',[UserController::class, 'CurrentUser'])->middleware('auth');
Route::post('/logout',[UserController::class, 'Logout']);

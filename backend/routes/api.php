<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TaskController;
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
Route::get('/currentuser',[UserController::class, 'CurrentUser']);
Route::post('/logout',[UserController::class, 'Logout']);

//Project 
Route::post('/createproject',[ProjectController::class, 'CreateProject']);
Route::get('/allproject',[ProjectController::class, 'AllProject']);
Route::get('/getproject/{id}',[ProjectController::class, 'GetProject']);
Route::post('/updateproject',[ProjectController::class, 'UpdateProject']);
Route::post('/deleteproject',[ProjectController::class, 'DeleteProject']);

//task
Route::post('/createtask',[TaskController::class, 'CreateTask']);
Route::get('/alltask',[TaskController::class, 'AllTask']);
Route::get('/gettask/{id}',[TaskController::class, 'GetTask']);
Route::post('/updatetask',[TaskController::class, 'UpdateTask']);
Route::post('/deletetask',[TaskController::class, 'DeleteTask']);

//notification
Route::post('/createnotif',[NotificationController::class, 'CreateNotif']);
Route::get('/allnotif',[NotificationController::class, 'AllNotif']);
Route::get('/getnotif/{id}',[NotificationController::class, 'GetNotif']);
Route::post('/updatenotif',[NotificationController::class, 'UpdateNotif']);
Route::post('/deletenotif',[NotificationController::class, 'DeleteNotif']);

//report
Route::post('/createreport',[ReportController::class, 'CreateReport']);
Route::get('/allreport',[ReportController::class, 'AllReport']);
Route::get('/getreport/{id}',[ReportController::class, 'GetReport']);
Route::post('/updatereport',[ReportController::class, 'UpdateReport']);
Route::post('/deletereport',[ReportController::class, 'DeleteReport']);
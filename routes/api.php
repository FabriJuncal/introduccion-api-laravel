<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;

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

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

// Se definen las rutas que no estarán protegidas por Sanctum, ya que no son requeridas.
// En esta instancia recien se obtendrá el API TOKEN para poder acceder a las rutas protegidas por Sanctum.
Route::post('auth/register',[AuthController::class, 'create']);
Route::post('auth/login',[AuthController::class, 'login']);

// Se utiliza el "middleware" de Sanctum para proteger las rutas.
// Se necesitará el API TOKEN para poder acceder a las rutas protegidas por el middleware de Sanctum.
Route::middleware(['auth:sanctum'])->group(function(){
    Route::resource('departments', DepartmentController::class);
    Route::resource('employees', EmployeeController::class);
    Route::get('employeesall', [EmployeeController::class, 'all']);
    Route::get('employeesbydepartment', [EmployeeController::class, 'EmployeesByDepartment']);
    Route::get('auth/logout',[AuthController::class, 'logout']);
});




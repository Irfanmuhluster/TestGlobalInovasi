<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
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
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ManagerController;
use App\Models\Manager;

Route::post('login', [AuthController::class,'login']);
Route::post('logout',  [AuthController::class,'logout']);


Route::middleware(['auth:api', 'role:superadmin'])->group(function () {
    Route::post('/companies/store', [CompanyController::class, 'store']); // Hanya super admin
    // Route::put('/companies/{id}', [CompanyController::class, 'update']);
    // Route::delete('/companies/{id}', [CompanyController::class, 'destroy']);
});


Route::middleware(['auth:api', 'role:manager'])->group(function () {
    Route::post('/manager/search', [ManagerController::class, 'index']);
    Route::put('/manager/{id}', [ManagerController::class, 'update']);
    Route::post('/employees/search', [EmployeeController::class, 'index']);
    Route::post('/employees/store', [EmployeeController::class, 'store']);
    Route::put('/employees/{id}', [EmployeeController::class, 'update']);
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);
});

Route::middleware(['auth:api', 'role:employee|manager'])->group(function () {
    Route::get('/employees/search', [EmployeeController::class, 'index']); 
    Route::get('/employees/{id}', [EmployeeController::class, 'show']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/employee', [App\Http\Controllers\AdminController::class, 'EmployeeList'])->name('admin.employee');
Route::get('/employees', [App\Http\Controllers\HomeController::class, 'employees'])->name('employees');
Route::get('/department', [App\Http\Controllers\AdminController::class, 'departmentList'])->name('admin.department');
Route::get('/state', [App\Http\Controllers\AdminController::class, 'stateList'])->name('admin.state');
Route::post('/addDepartment', [App\Http\Controllers\AdminController::class, 'addDepartment'])->name('admin.addDepartment');
Route::post('/addState', [App\Http\Controllers\AdminController::class, 'addState'])->name('admin.addState');
Route::post('/editDepartment/{id}', [App\Http\Controllers\AdminController::class, 'editDepartment'])->name('admin.editDepartment');
Route::post('/addcity', [App\Http\Controllers\AdminController::class, 'addcity'])->name('admin.addcity');

Route::get('/city', [App\Http\Controllers\AdminController::class, 'cityList'])->name('admin.city');
Route::get('/getStateByCountry/{id}', [App\Http\Controllers\AdminController::class, 'getStateByCountry'])->name('admin.getStateByCountry');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

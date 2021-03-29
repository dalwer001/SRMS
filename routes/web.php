<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\productController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SaleController;
use App\Http\Controllers\Backend\TaskController;

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

//login page route....
Route::get('/', function () {
    return view(view:'login');
});


//dashboard route...
Route::get('/dashboard', function () {
    return view(view:'backend.main');
});
Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard.list');



// products route...
Route::get('/products',[ProductController::class,'products'])->name('products.list');
Route::post('/products',[ProductController::class,'create'])->name('products.create');
Route::get('/products/delete/{id}',[ProductController::class,'delete'])->name('products.delete');
Route::get('/products/edit/{id}',[ProductController::class,'edit'])->name('products.edit');
Route::put('/products/update/{id}',[ProductController::class,'update'])->name('products.update');


//employee route........
Route::get('/employees',[EmployeeController::class,'employees'])->name('employees.list');
Route::post('/employees',[EmployeeController::class,'create'])->name('employees.create');
Route::get('/employees/delete/{id}',[EmployeeController::class,'delete'])->name('employees.delete');
Route::get('/employees/edit/{id}',[EmployeeController::class,'edit'])->name('employees.edit');
Route::put('/employees/update/{id}',[EmployeeController::class,'update'])->name('employees.update');



// task route .....
Route::get('/tasks',[TaskController::class,'tasks'])->name('tasks.list');


// sales
Route::get('/sales',[SaleController::class,'sales'])->name('sales.list');



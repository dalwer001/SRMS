<?php

use App\Http\Controllers\Backend\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\productController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SaleController;
use App\Http\Controllers\Backend\TaskController;
use App\Http\Controllers\Backend\UserController;

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
Route::get('/', [UserController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');





//Admin

Route::group(['prefix' => 'admin'], function () {

    //dashboard route...

    Route::group(['middleware'=>'admin-auth'],function(){
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.list');

        // products route...
        Route::get('/products', [ProductController::class, 'products'])->name('products.list');
        Route::post('/products', [ProductController::class, 'create'])->name('products.create');
        Route::get('/products/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');
        Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');


        //product-categories
        Route::get('/productCategory', [ProductController::class, 'categories'])->name('products.categories');
        Route::post('/productCategory', [ProductController::class, 'category_create'])->name('productCategory.create');
        Route::get('/productCategory/delete/{id}', [ProductController::class, 'category_delete'])->name('productCategory.delete');

        //customers
        Route::get('/customers/delete/{id}', [CustomerController::class, 'delete'])->name('customers.delete');


        //task create
    Route::post('/tasks', [TaskController::class, 'create'])->name('tasks.create');



        //employee route........
        Route::get('/employees', [EmployeeController::class, 'employees'])->name('employees.list');
        Route::post('/employees', [EmployeeController::class, 'create'])->name('employees.create');
        Route::get('/employees/delete/{id}', [EmployeeController::class, 'delete'])->name('employees.delete');
        Route::get('/employees/edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::put('/employees/update/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    });
});




//Employee
Route::group(['prefix' => 'employee'], function () {

    Route::group(['middleware'=>'employee-auth'],function(){


    // sales
    Route::get('/new-sale', [SaleController::class, 'newSale'])->name('newSale.list');


    //customer route.........
    Route::post('/customers', [CustomerController::class, 'create'])->name('customers.create');
    Route::get('/customers/edit/{id}', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/update/{id}', [CustomerController::class, 'update'])->name('customers.update');

    });
});



//both  user 
//task
Route::get('/tasks', [TaskController::class, 'tasks'])->name("tasks.list")->middleware('auth');
//sales
Route::get('/manage-sales', [SaleController::class, 'mangeSales'])->name('manageSales.list')->middleware('auth');
Route::get('/sale-summary', [SaleController::class, 'saleSummary'])->name('saleSummary.list')->middleware('auth');
//customers
Route::get('/customers', [CustomerController::class, 'customers'])->name('customers.list')->middleware('auth');

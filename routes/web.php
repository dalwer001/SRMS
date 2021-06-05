<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Backend\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\productController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\ReportController;
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
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.list')->middleware('auth');





//Admin

Route::group(['prefix' => 'admin'], function () {

    //dashboard route...

    Route::group(['middleware' => 'admin-auth'], function () {

        // products route...
        Route::get('/products', [ProductController::class, 'products'])->name('products.list');
        Route::post('/products', [ProductController::class, 'create'])->name('products.create');
        Route::get('/products/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');
        Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::get('/product/{id}/{status}', [ProductController::class, 'statusUpdate'])->name('status.update');



        //product-categories
        Route::get('/productCategory', [ProductController::class, 'categories'])->name('products.categories');
        Route::post('/productCategory', [ProductController::class, 'category_create'])->name('productCategory.create');
        Route::get('/productCategory/delete/{id}', [ProductController::class, 'category_delete'])->name('productCategory.delete');
        Route::get('/productCategory/edit/{id}', [ProductController::class, 'category_edit'])->name('productCategory.edit');
        Route::put('/productCategory/update/{id}', [ProductController::class, 'category_update'])->name('productCategory.update');


        //customers
        Route::get('/customers/delete/{id}', [CustomerController::class, 'delete'])->name('customers.delete');


        //task create
        Route::post('/tasks', [TaskController::class, 'create'])->name('tasks.create');
        Route::get('/tasks', [TaskController::class, 'tasks'])->name("tasks.list");
        Route::get('/tasks/delete/{id}', [TaskController::class, 'delete'])->name("tasks.delete");


//sales delete
        Route::get('/sales-details/delete/{id}', [SaleController::class, 'delete'])->name('salesDetails.delete');


        //employee route........
        Route::get('/employees', [EmployeeController::class, 'employees'])->name('employees.list');
        Route::post('/employees', [EmployeeController::class, 'create'])->name('employees.create');
        Route::get('/employees/delete/{id}', [EmployeeController::class, 'delete'])->name('employees.delete');
        Route::get('/employees/edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::put('/employees/update/{id}', [EmployeeController::class, 'update'])->name('employees.update');
        Route::get('/employees/viewDetails/{id}', [EmployeeController::class, 'view'])->name('employees.view');



        //report days
        Route::get('/reports', [ReportController::class, 'report'])->name('sales.report');

    });
});




//Employee
Route::group(['prefix' => 'employee'], function () {

    Route::group(['middleware' => 'employee-auth'], function () {

        Route::get('/employee-profile', [ProfileController::class, 'employeeProfile'])->name('employee.profile');
        Route::post('/employee-profile/updatepassword/{id}', [ProfileController::class, 'profileUpdate'])->name('employee.profileUpdate');

        //task
        Route::get('/employee-task/{id}', [TaskController::class, 'employeeTask'])->name('employeeTask.list');
        // sales
        Route::get('/new-sale', [SaleController::class, 'newSale'])->name('newSale.list');
        Route::post('/new-sale/productSold', [SaleController::class, 'productSold'])->name('productSold.list');

        Route::post('/new-sale', [SaleController::class, 'saleProductCreate'])->name('saleProduct.create');
        Route::get('/new-sale/delete/{id}', [SaleController::class, 'saleProductDelete'])->name('newSale.delete');

        //customer route.........
        Route::post('/customers', [CustomerController::class, 'create'])->name('customers.create');
        Route::get('/customers/edit/{id}', [CustomerController::class, 'edit'])->name('customers.edit');
        Route::put('/customers/update/{id}', [CustomerController::class, 'update'])->name('customers.update');
    });
});


//both  user
//sales
Route::get('/sales-details', [SaleController::class, 'salesDetails'])->name('saleDetails.list')->middleware('auth');
Route::get('/sales-details/view/{id}', [SaleController::class, 'salesDetailsView'])->name('salesDetailsView.list')->middleware('auth');

//customers
Route::get('/customers', [CustomerController::class, 'customers'])->name('customers.list')->middleware('auth');
//forgetPass
Route::get('/forget-password',[UserController::class,'forgetPass'])->name('forgetPassword');
Route::post('/forget-password/submit',[UserController::class,'createNewPass'])->name('newPass.create');
Route::get('/reset-link/{token}/{email}', [UserController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset/submit', [UserController::class, 'submitPassword'])->name('password.submit');

Route::get('/get-customer/{id}', [ApiController::class, 'customerDetails']);



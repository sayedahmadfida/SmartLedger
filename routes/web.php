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
    return redirect()->route('login');
});

Auth::routes();

Route::get('users/setInfo', [App\Http\Controllers\AuthInfoController::class, 'index'])->name('user.setInfo');
Route::prefix('/')->middleware(['auth', 'SetSession'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // User Managements
    Route::resource('users', App\Http\Controllers\UserManagementController::class);
    Route::post('user-action', [App\Http\Controllers\UserManagementController::class, 'userAction'])->name('userAction');
    Route::post('/user/check-username', [App\Http\Controllers\UserManagementController::class, 'postCheckUsername'])->name('user.checkUsername');
    Route::post('/user/check-email', [App\Http\Controllers\UserManagementController::class, 'postCheckEmail'])->name('user.checkUserEmail');

    Route::resource('userInfo', App\Http\Controllers\UserInfoController::class);
    Route::resource('userProfileAvatar', App\Http\Controllers\UserAvatarController::class);

    // Rols Managements
    Route::resource('roles', App\Http\Controllers\RoleController::class);

    
    // Transaction 
    Route::resource('transaction', App\Http\Controllers\TransactionController::class);
    
    
    // Customers
    Route::resource('customer', App\Http\Controllers\CustomerController::class);
    Route::get('customer/getPayments/{customers}', [App\Http\Controllers\CustomerController::class, 'payment_data'])->name('customer.payment_data');
    Route::get('customer/make-payment/{customers}', [App\Http\Controllers\CustomerController::class, 'make_payment'])->name('customer.makePayment');
    Route::get('customer/make-credit/{customers}', [App\Http\Controllers\CustomerController::class, 'make_credit'])->name('customer.makeCredit');
    
    
    
    // Supplier
    
    Route::resource('supplier', App\Http\Controllers\SupplierController::class);

    
    // Phone
    Route::resource('phone', App\Http\Controllers\PhoneController::class);
    
    
    // Clear Account
    Route::resource('decleration-date', App\Http\Controllers\DeclerationDateController::class);
    
        
    // Rols Managements
    Route::resource('roles', App\Http\Controllers\RoleController::class);


    // User Activities
    Route::resource('user-activities', App\Http\Controllers\UserActivityController::class);


});

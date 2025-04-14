<?php

use App\Exports\SalesExport;
use App\Exports\UsersExport;
use App\Exports\ProductsExport;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;

use App\Http\Controllers\SalesExportController;
use App\Http\Controllers\UsersExportController;
use App\Http\Controllers\ProductsExportController;

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::middleware(['authenticate'])->group(function () {
    // Home Route
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Product Route
    Route::resource('products', ProductController::class);

    // Sale Route
    // Route::get('/sales/{id}/invoice', [SaleController::class, 'showInvoice'])->name('sales.invoice');
    Route::get('/sales/{id}/invoice', [SaleController::class, 'showInvoice'])->name('sales.invoice');
    Route::resource('sales', SaleController::class);

    // Member Route
    Route::resource('members', MemberController::class);

    // Superadmin Route
    Route::middleware(['superadmin'])->group(function () {
        // User Route
        Route::resource('user', UserController::class);

        Route::get('/sales/export', [SalesExportController::class, 'export'])->name('sales.export');
        Route::get('/sales/export/excel', function () {
            return Excel::download(new SalesExport, 'sales.xlsx');
        })->name('sales.export');    
        
        Route::get('/users/export', [UsersExportController::class, 'export'])->name('users.export');
        Route::get('/users/export/excel', function () {
            return Excel::download(new UsersExport, 'users.xlsx');
        })->name('users.export'); 

        Route::get('/products/export', [ProductsExportController::class, 'export'])->name('products.export');
        Route::get('/products/export/excel', function () {
            return Excel::download(new ProductsExport, 'products.xlsx');
        })->name('products.export'); 

        // Product Route
        Route::put('/products/{id}/update-stock', [ProductController::class, 'updateStock'])->name('products.updateStock');
    });
    
    // User Route
    Route::middleware(['user'])->group(function () {    
        
        Route::post('/confirm-sale', [SaleController::class, 'confirmationStore'])->name('sales.confirmationStore');
        // Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    });
});


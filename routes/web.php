<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\GetProductsController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin'
])->group(function () {

    Route::as('admin.')->prefix('admin')->group( function () {

        // ROUTES FOR ADMIN INDEX

        Route::get('/', [ AdminController::class, 'index'] )->name('index');

        // ROUTES FOR WAREHOUSES

        Route::as('warehouse.')->prefix('warehouse')->group(function (){

            Route::get('/',            [ WarehouseController::class,'index']   );
            Route::get('index',        [ WarehouseController::class,'index']   )->name('index');
            Route::get('create',       [ WarehouseController::class,'create']  )->name('create');
            Route::get('edit/{id}',    [ WarehouseController::class,'edit']    )->name('edit');
            Route::post('update',      [ WarehouseController::class,'update']  )->name('update');
            Route::get('destroy/{id}', [ WarehouseController::class,'destroy'] )->name('destroy');
            Route::get('show/{id}',    [ WarehouseController::class,'show']    )->name('show');
            Route::post('store',       [ WarehouseController::class,'store']   )->name('store');
        });

        // ROUTES FOR CATEGORIES

        Route::as('category.')->prefix('category')->group(function (){

            Route::get('/',            [ CategoryController::class,'index']   );
            Route::get('index',        [ CategoryController::class,'index']   )->name('index');
            Route::get('create',       [ CategoryController::class,'create']  )->name('create');
            Route::get('edit/{id}',    [ CategoryController::class,'edit']    )->name('edit');
            Route::post('update',      [ CategoryController::class,'update']  )->name('update');
            Route::get('destroy/{id}', [ CategoryController::class,'destroy'] )->name('destroy');
            Route::get('show/{id}',    [ CategoryController::class,'show']    )->name('show');
            Route::post('store',       [ CategoryController::class,'store']   )->name('store');
        });

        // ROUTES FOR UNITS

        Route::as('unit.')->prefix('unit')->group(function (){

            Route::get('/',            [ UnitController::class,'index']   );
            Route::get('index',        [ UnitController::class,'index']   )->name('index');
            Route::get('create',       [ UnitController::class,'create']  )->name('create');
            Route::get('edit/{id}',    [ UnitController::class,'edit']    )->name('edit');
            Route::post('update',      [ UnitController::class,'update']  )->name('update');
            Route::get('destroy/{id}', [ UnitController::class,'destroy'] )->name('destroy');
            Route::get('show/{id}',    [ UnitController::class,'show']    )->name('show');
            Route::post('store',       [ UnitController::class,'store']   )->name('store');
        });

        // ROUTES FOR PRODUCTS

        Route::as('product.')->prefix('product')->group(function (){

            Route::get('/',            [ ProductController::class,'index']   );
            Route::get('index',        [ ProductController::class,'index']   )->name('index');
            Route::get('create',       [ ProductController::class,'create']  )->name('create');
            Route::get('edit/{id}',    [ ProductController::class,'edit']    )->name('edit');
            Route::post('update',      [ ProductController::class,'update']  )->name('update');
            Route::get('destroy/{id}', [ ProductController::class,'destroy'] )->name('destroy');
            Route::get('show/{id}',    [ ProductController::class,'show']    )->name('show');
            Route::post('store',       [ ProductController::class,'store']   )->name('store');
        });

        // ROUTES FOR PURCHASES

        Route::as('purchase.')->prefix('purchase')->group(function (){

            Route::get('/',                        [ PurchaseController::class,'allPurchases']);
            Route::get('allpurchases',             [ PurchaseController::class,'allPurchases']        )->name('allpurchases');
            Route::get('create',                   [ PurchaseController::class,'create']              )->name('create');
            Route::post('store',                   [ PurchaseController::class,'store']               )->name('store');

            Route::post('updatePurchase',          [ PurchaseController::class,'updatePurchase']      )->name('updatePurchase');
            Route::get('deletePurchase/{id}',      [ PurchaseController::class,'deletePurchase']      )->name('deletePurchase');
            Route::get('show/{id}',                [ PurchaseController::class,'show']                )->name('show');

            Route::get('approved',                 [ PurchaseController::class,'approvedPurchases']   )->name('approvedPurchase');

            Route::get('purchaseDetails/{id}',     [ PurchaseController::class,'purchaseDetails']     )->name('purchaseDetails');

            Route::get('report',                   [PurchaseController::class, 'dailyPurchaseReport'] )->name('dailyPurchaseReport');

            Route::get('report/export',            [PurchaseController::class, 'getPurchaseReport']   )->name('getPurchaseReport');

            Route::post('report/export',           [PurchaseController::class, 'exportPurchaseReport'])->name('exportPurchaseReport');

        });

        // ROUTES FOR SUPPLIERS

        Route::as('supplier.')->prefix('supplier')->group(function (){

            Route::get('/',             [ SupplierController::class,'index']   );
            Route::get('index',         [ SupplierController::class,'index']   )->name('index');
            Route::get('create',        [ SupplierController::class,'create']  )->name('create');
            Route::get('edit/{id}',     [ SupplierController::class,'edit']    )->name('edit');
            Route::post('update',       [ SupplierController::class,'update']  )->name('update');
            Route::get('destroy/{id}',  [ SupplierController::class,'destroy'] )->name('destroy');
            Route::get('show/{id}',     [ SupplierController::class,'show']    )->name('show');
            Route::post('store',        [ SupplierController::class,'store']   )->name('store');
        });

        // ROUTE TO GET ALL PRODUCT

        Route::get('get-all-product',   [ GetProductsController::class, 'GetProducts'])->name('get-all-product');

        // ROUTE FOR CUSTOMERS

        Route::as('customer.')->prefix('customer')->group(function () {

            Route::get('/',             [ CustomerController::class,'index']   );
            Route::get('index',         [ CustomerController::class,'index']   )->name('index');
            Route::get('create',        [ CustomerController::class,'create']  )->name('create');
            Route::get('edit/{id}',     [ CustomerController::class,'edit']    )->name('edit');
            Route::post('update',       [ CustomerController::class,'update']  )->name('update');
            Route::get('destroy/{id}',  [ CustomerController::class,'destroy'] )->name('destroy');
            Route::get('show/{id}',     [ CustomerController::class,'show']    )->name('show');
            Route::post('store',        [ CustomerController::class,'store']   )->name('store');

        });

        // ROUTE FOR ORDER

        Route::as('order.')->prefix('order')->group(function () {

            Route::get('pending',                     [OrderController::class, 'pendingOrders']   )->name('pendingOrders');
            Route::get('pending/{order_id}',          [OrderController::class, 'orderDetails']    )->name('orderPendingDetails');
            Route::get('complete',                    [OrderController::class, 'completeOrders']  )->name('completeOrders');
            Route::get('complete/{order_id}',         [OrderController::class, 'orderDetails']    )->name('orderCompleteDetails');
            Route::get('details/{order_id}/download', [OrderController::class, 'downloadInvoice'] )->name('downloadInvoice');
            Route::get('due',                         [OrderController::class, 'dueOrders']       )->name('dueOrders');
            Route::get('due/pay/{order_id}',          [OrderController::class, 'dueOrderDetails'] )->name('dueOrderDetails');
            Route::put('due/pay/update',              [OrderController::class, 'updateDueOrder']  )->name('updateDueOrder');
            Route::put('update',                      [OrderController::class, 'updateOrder']     )->name('updateOrder');

        });

        // ROUTE FOR POS

        Route::as('pos.')->prefix('pos')->group(function () {

            Route::get('/',                      [PosController::class, 'index'])->name('index');
            Route::post('cart/add',              [PosController::class, 'addCartItem'])->name('addCartItem');
            Route::post('cart/update/{rowId}',   [PosController::class, 'updateCartItem'])->name('updateCartItem');
            Route::delete('cart/delete/{rowId}', [PosController::class, 'deleteCartItem'])->name('deleteCartItem');
            Route::post('invoice',               [PosController::class, 'createInvoice'])->name('createInvoice');
            Route::post('/',                     [OrderController::class, 'createOrder'])->name('createOrder');

        });


    });
});

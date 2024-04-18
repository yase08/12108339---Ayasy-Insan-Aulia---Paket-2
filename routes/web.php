<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.index');
});
Route::middleware("isLogin")->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    Route::middleware("isAdmin")->group(function () {
        // User
        Route::get("/dashboard/user", [UserController::class, "index"])->name("user");
        Route::get("/dashboard/user/create", [UserController::class, "create"])->name("user.create");
        Route::post("/dashboard/user/store", [UserController::class, "store"])->name("user.store");
        Route::get("/dashboard/user/edit/{id}", [UserController::class, "edit"])->name("user.edit");
        Route::patch("/dashboard/user/update/{id}", [UserController::class, "update"])->name("user.update");
        Route::delete("/dashboard/user/destroy/{id}", [UserController::class, "destroy"])->name("user.destroy");
    });

    Route::middleware("isStaff")->group(function () {
        Route::get("/dashboard/sale/create", [SaleController::class, "create"])->name("sale.create");
        Route::post("/dashboard/sale/store", [SaleController::class, "store"])->name("sale.store");
    });

    // Sale
    Route::get("/dashboard/sale", [SaleController::class, "index"])->name("sale");
    Route::get("/dashboard/sale/export", [SaleController::class, "export"])->name("export");
    Route::get("/dashboard/sale/pdf", [SaleController::class, "pdf"])->name("pdf");
    Route::get("/dashboard/sale/download/{id}", [SaleController::class, "download"])->name("sale.download");
    Route::get("/dashboard/sale/invoice", [SaleController::class, "invoiceView"])->name("sale.invoiceView");
    Route::post("/dashboard/sale/invoiceStore", [SaleController::class, "invoice"])->name("sale.invoice");
    Route::get("/dashboard/sale/edit/{id}", [SaleController::class, "edit"])->name("sale.edit");
    Route::patch("/dashboard/sale/update/{id}", [SaleController::class, "update"])->name("sale.update");
    Route::delete("/dashboard/sale/destroy/{id}", [SaleController::class, "destroy"])->name("sale.destroy");

    // Product
    Route::get("/dashboard/product", [ProductController::class, "index"])->name("product");
    Route::get("/dashboard/product/create", [ProductController::class, "create"])->name("product.create");
    Route::post("/dashboard/product/store", [ProductController::class, "store"])->name("product.store");
    Route::get("/dashboard/product/edit/{id}", [ProductController::class, "edit"])->name("product.edit");
    Route::patch("/dashboard/product/update/{id}", [ProductController::class, "update"])->name("product.update");
    Route::patch("/dashboard/product/updateStock/{id}", [ProductController::class, "updateStock"])->name("product.updateStock");
    Route::delete("/dashboard/product/destroy/{id}", [ProductController::class, "destroy"])->name("product.destroy");
});

require __DIR__ . '/auth.php';

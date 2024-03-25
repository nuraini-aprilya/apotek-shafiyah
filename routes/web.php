<?php

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

Route::get('/', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');
Route::get('/product', [App\Http\Controllers\User\DashboardController::class, 'product'])->name('product');
Route::get('/discount', [App\Http\Controllers\User\DashboardController::class, 'discount'])->name('discount');
Route::get('/detail-product/{product}', [App\Http\Controllers\User\DashboardController::class, 'detailProduct'])->name('detail.product');
Route::get('/search-product', [App\Http\Controllers\User\DashboardController::class, 'searchProduct'])->name('search.product');
Route::get('/kategori/{category}', [App\Http\Controllers\User\DashboardController::class, 'category'])->name('category');
Route::post('/cart', [App\Http\Controllers\User\CartController::class, 'store'])->name('store.cart');
Route::post('/order', [App\Http\Controllers\User\OrderController::class, 'store'])->name('store.order');
Route::put('/order/{order}', [App\Http\Controllers\User\OrderController::class, 'cancel'])->name('cancel.order');
Route::delete('/cart/{cartId}/{productId}', [App\Http\Controllers\User\CartController::class, 'destroy'])->name('destroy.cart');

Route::post('/resep', [App\Http\Controllers\User\RecipeController::class, 'store'])->name('store.recipe');;


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    // Cashier
    Route::get('/cashier', [App\Http\Controllers\Admin\CashierController::class, 'index'])->name('cashier');

    Route::resource('/cart', App\Http\Controllers\Admin\CartController::class);

    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Product
    Route::resource('/product', App\Http\Controllers\Admin\ProductController::class);
    Route::get('/dwindling-product', [App\Http\Controllers\Admin\ProductController::class, 'dwindling'])->name('dwindling.product');
    Route::get('/expire-product', [App\Http\Controllers\Admin\ProductController::class, 'expire'])->name('expire.product');

    // Discount
    Route::resource('/discount', App\Http\Controllers\Admin\DiscountController::class);

    // Category
    Route::resource('/category', App\Http\Controllers\Admin\CategoryController::class);

    // Type
    Route::resource('/type', App\Http\Controllers\Admin\TypeController::class);

    // Brand
    Route::resource('/brand', App\Http\Controllers\Admin\BrandController::class);

    // Unit
    Route::resource('/unit', App\Http\Controllers\Admin\UnitController::class);

    // Order
    Route::resource('/order', App\Http\Controllers\Admin\OrderController::class);

    // User
    Route::resource('/user', App\Http\Controllers\Admin\UserController::class);

    // Supplier
    Route::resource('/supplier', App\Http\Controllers\Admin\SupplierController::class);

    // Purchase
    Route::resource('/purchase', App\Http\Controllers\Admin\PurchaseController::class);
    Route::get('/getPurchaseDetails/{id}', [App\Http\Controllers\Admin\PurchaseController::class, 'getPurchaseDetails']);

    // Receipt
    Route::resource('/receipt', App\Http\Controllers\Admin\ReceiptController::class);

    // Refund
    Route::resource('/refund', App\Http\Controllers\Admin\RefundController::class);

    // Report
    Route::get('/report/receipt', [App\Http\Controllers\Admin\ReportController::class, 'receipt'])->name('report.receipt');
    Route::get('/report/purchase', [App\Http\Controllers\Admin\ReportController::class, 'purchase'])->name('report.purchase');
    Route::get('/report/order', [App\Http\Controllers\Admin\ReportController::class, 'order'])->name('report.order');

    // Banner
    Route::resource('/banner', App\Http\Controllers\Admin\BannerController::class);

    // Profile
    Route::resource('/profile', App\Http\Controllers\Admin\ProfileController::class);

    // Recipe
    Route::resource('/recipe', App\Http\Controllers\Admin\RecipeController::class);
    Route::post('/approveRecipe/{recipe}', [App\Http\Controllers\Admin\RecipeController::class, 'approveRecipe'])->name('approveRecipe');
    Route::post('/rejectRecipe/{recipe}', [App\Http\Controllers\Admin\RecipeController::class, 'rejectRecipe'])->name('rejectRecipe');
});

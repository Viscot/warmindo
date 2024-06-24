<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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


Route::get("/", [UserController::class, "index"]);
Route::get("/register", [UserController::class, "index"]);
Route::get("/login", [UserController::class, "index"]);
Route::get("/category/{id}", [UserController::class, "showByCategory"])->name('show_by_category');
Route::get("/search", [UserController::class, "searchByName"])->name('search');



Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get("/logout", [LoginController::class, "logout"]);
    Route::get("/profile", [UserController::class, "profile"]);
    Route::put("/profile", [UserController::class, "updateProfile"])->name('profile.update');
    Route::post("/profile/image", [UserController::class, "updateProfileImage"])->name('profile.updateImage');

    Route::get("/cart", [UserController::class, "cart"]);
    Route::post("/cart", [UserController::class, "addToCart"])->name('addToCart');
    Route::delete('/cart/{cartItem}', [UserController::class, 'removeCartItem'])->name('cart.remove');
    Route::get('/checkout', [UserController::class, 'checkout'])->name('checkout');
    Route::post('/order/cancel', [UserController::class, 'cancelOrder'])->name('order.cancel');



    Route::get("/order", [UserController::class, "order"]);
    Route::put('/cart/{cartItem}', [UserController::class, 'updateCartItem'])->name('cart.update');


    // admin
    Route::get("/admin", [AdminController::class, "index"])->name('admin.dashboard');
    Route::get("/admin/users", [AdminController::class, "user"])->name('admin.users');
    Route::get('/admin/menu', [AdminController::class, 'menu'])->name('admin.menu');
    Route::delete('/admin/menu/{menu}', [AdminController::class, 'menuDestroy'])->name('menu.destroy');


    Route::post('/admin/menu', [AdminController::class, 'menuStore'])->name('menu.store');
    Route::put('/admin/menu/{menu}', [AdminController::class, 'menuUpdate'])->name('menu.update');





    Route::get('admin/orders', [AdminController::class, 'orders'])->name('admin.orders.index');
    Route::post('admin/orders/{cart}', [AdminController::class, 'update'])->name('admin.orders.update');
    Route::delete('admin/orders/{cart}', [AdminController::class, 'destroy'])->name('admin.orders.destroy');
});




Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::name('js.')->group(function () {
    Route::get('dynamic.js', 'JsController@dynamic')->name('dynamic');
});

<?php

use App\Http\Controllers\CustomUserAuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingController;

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
/*
Route::get('/', function () {
    return view('v_home');
});
*/

// AdminLte Routes
Route::get('/', [HomeController::class, 'index'])->middleware('userLoggedIn');

Route::get('/user', [UserController::class, 'index'])->name('user')->middleware('adminLoggedIn');
Route::get('/user/add', [UserController::class, 'addPage'])->middleware('adminLoggedIn');
Route::post('/user/add/submit', [UserController::class, 'addData'])->middleware('adminLoggedIn');
Route::get('/user/edit/{user_id}', [UserController::class, 'editPage'])->middleware('adminLoggedIn');
Route::post('/user/edit/submit/{user_id}', [UserController::class, 'editData'])->middleware('adminLoggedIn');
Route::get('/user/delete/{user_id}', [UserController::class, 'deleteData'])->middleware('adminLoggedIn');

Route::get('/product', [ProductController::class, 'index'])->name('product')->middleware('adminLoggedIn');
Route::get('/product/detail/{product_id}', [ProductController::class, 'detail'])->middleware('adminLoggedIn');
Route::get('/product/add', [ProductController::class, 'addPage'])->middleware('adminLoggedIn');
Route::post('/product/add/submit', [ProductController::class, 'addData'])->middleware('adminLoggedIn');
Route::get('/product/edit/{product_id}', [ProductController::class, 'editPage'])->middleware('adminLoggedIn');
Route::post('/product/edit/submit/{product_id}', [ProductController::class, 'editData'])->middleware('adminLoggedIn');
Route::get('/product/delete/{product_id}', [ProductController::class, 'deleteData'])->middleware('adminLoggedIn');

Route::get('/shopping_cart', [ShoppingController::class, 'index'])->name('shopping_cart')->middleware('adminLoggedIn');
Route::get('/shopping_cart/add', [ShoppingController::class, 'addPage'])->middleware('adminLoggedIn');
Route::post('/shopping_cart/add/submit', [ShoppingController::class, 'addData'])->middleware('adminLoggedIn');
Route::get('/shopping_cart/edit/{shopping_cart_id}', [ShoppingController::class, 'editPage'])->middleware('adminLoggedIn');
Route::post('/shopping_cart/edit/submit/{shopping_cart_id}', [ShoppingController::class, 'editData'])->middleware('adminLoggedIn');
Route::get('/shopping_cart/delete/{shopping_cart_id}', [ShoppingController::class, 'deleteData'])->middleware('adminLoggedIn');

//Route::view('/', 'v_home');
// Main Page Route
Route::get('/register', [CustomUserAuthController::class, 'register'])->name('register')->middleware('alreadyLoggedIn');
Route::post('/register/submit', [CustomUserAuthController::class, 'registerSubmit'])->name('register.submit')->middleware('alreadyLoggedIn');
Route::get('/login', [CustomUserAuthController::class, 'login'])->name('login')->middleware('alreadyLoggedIn');
Route::post('/login/submit', [CustomUserAuthController::class, 'loginSubmit'])->name('login.submit')->middleware('alreadyLoggedIn');

Route::get('/logout', [CustomUserAuthController::class, 'logout']);
Route::post('/order', [HomeController::class, 'order'])->name('order');
Route::get('/delete-order/{shopping_cart_id}', [HomeController::class, 'deleteOrder']);

// Auth::routes();
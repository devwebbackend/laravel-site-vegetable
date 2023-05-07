<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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
Route::resource('orders',OrderController::class );
Route::resource('sliders',SliderController::class );
Route::resource('products',ProductController::class);
Route::get('activeProduct/{id}',[ProductController::class,'activeProduct'])->name('product.active');
Route::get('unactiveProduct/{id}',[ProductController::class,'unactiveSlider'])->name('product.unactive');
Route::get('activeSlider/{id}',[SliderController::class,'activeSlider'])->name('slider.active');
Route::get('unactiveSlider/{id}',[SliderController::class,'unactiveSlider'])->name('slider.unactive');
Route::resource('categories',CategoryController::class);
/* Route::get('/categories',[CategoryController::class,'index'] )->name('admin.category');
Route::get('/categories/create',[CategoryController::class,'addCategory'] )->name('admin.addcategory'); */
Route::get('/admin',[AdminController::class,'admin'] )->name('admin.home');
Route::get('/home',[ClientController::class,'index'] )->name('client.home');
Route::get('/shop',[ClientController::class,'shop'] )->name('client.shop');
Route::get('/cart',[ClientController::class,'cart'] )->name('client.cart');
Route::get('/addtocart/{id}',[ClientController::class,'addToCart'] )->name('addtocart');
Route::post('updateqty/{id}',[ClientController::class,'updateQty'] );
Route::post('remouve_account/{id}',[ClientController::class,'removeItem'] );
Route::get('/checkout',[ClientController::class,'checkout'] )->name('client.checkout');

Route::post('/checkoutpost', [ClientController::class, 'checkoutpost'])->name('client.checkoutpost');
Route::post('/paiement-success', [ClientController::class, 'paiement_success']);


Route::get('login',[ClientController::class,'login'] );
Route::get('logout', [ClientController::class, 'logout']);
Route::post('accessaccount', [ClientController::class, 'accessaccount']);
Route::get('register',[ClientController::class,'register'] );
Route::post('signeup', [ClientController::class, 'createaccount']);
route::get('showproduct/{id}',[ClientController::class,'showProduct'])->name('client.showproduct');
/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
 */
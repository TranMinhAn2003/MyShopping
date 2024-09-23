<?php

use App\Http\Controllers\Backend\AjaxAttributeController;
use App\Http\Controllers\Backend\AjaxController;
use App\Http\Controllers\Backend\AttributeCatalogueController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\LocationController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Middleware\CheckStatusUserMiddleware;
use App\Http\Middleware\LoginMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::get('detail/{id}',[HomeController::class,'show'])->name('home.show');

Route::group(['prefix'=>'cart'],function (){
    Route::post('/add',[CartController::class,'addCart'])->name('cart.add');
   Route::get('/show',[CartController::class,'showCart'])->name('show.cart');
   Route::get('/destroy/{id}',[CartController::class,'deleteCart'])->name('remove.cart');
   Route::post('/update',[CartController::class,'updateQuantityCart'])->name('update.cart');
});
 Route::group(['prefix'=>'payment'],function (){
     Route::get('index',[PaymentController::class,'index'])->name('payment.index');
     Route::post('store',[PaymentController::class,'store'])->name('payment.store');
 });
Route::get('index', [AuthController::class, 'index'])->name('index');

Route::post('login', [AuthController::class, 'login'])->name('login');

// Đăng xuất
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Trang dashboard chỉ dành cho người đã đăng nhập
Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index')->middleware(AuthenticateMiddleware::class);
Route::group(['prefix'=>'register'],function (){
    Route::get('index',[RegisterController::class,'index'])->name('register.index');
    Route::get('formstep2',[RegisterController::class,'formStep2'])->name('register.formStep2');
    Route::post('storeStep1',[RegisterController::class,'storeStep1'])->name('register.storeStep1');
    Route::post('storeStep2',[RegisterController::class,'storeStep2'])->name('register.storeStep2');
});
Route::get('/active/{user}/{token}',[RegisterController::class,'active'])->name('register.active');

Route::post('api/fetch-district',[RegisterController::class,'fatchDistrict']);
Route::post('api/fetch-ward',[RegisterController::class,'fatchWard']);

Route::get('/forget-password',[HomeController::class,'forgetPass'])->name('forget-password');
Route::post('/forget-password',[HomeController::class,'postforgetPass']);
Route::get('/get-passWord/{user}/{token}',[HomeController::class,'getPass'])->name('getPass');
Route::post('/get-passWord/{user}/{token}',[HomeController::class,'postPass']);




Route::group([ 'prefix'=>'user'],function ()
{
    Route::get('index',[UserController::class,'index'])->name('user.index')->middleware(AuthenticateMiddleware::class);
    Route::get('create',[UserController::class,'create'])->name('user.create')->middleware(AuthenticateMiddleware::class);
    Route::post('store',[UserController::class,'store'])->name('user.store')->middleware(AuthenticateMiddleware::class);
    Route::get('edit/{id}',[UserController::class,'edit'])->name('user.edit')->middleware(AuthenticateMiddleware::class);
    Route::put('update/{id}',[UserController::class,'update'])->name('user.update')->middleware(AuthenticateMiddleware::class);
    Route::get('delete/{id}',[UserController::class,'delete'])->name('user.delete')->middleware(AuthenticateMiddleware::class);
    Route::delete('destroy/{id}',[UserController::class,'destroy'])->name('user.destroy')->middleware(AuthenticateMiddleware::class);

});

Route::get('user/ajax/location/getLocation',[LocationController::class,'getLocation'])->name('ajax.location.getLocation');
Route::get('user/edit/ajax/location/getLocation',[LocationController::class,'getLocation'])->name('ajax.location.getLocation');
Route::post('user/ajax/dashboard/changeStatus',[AjaxController::class,'changeStatus'])->name('ajax.change.status');
Route::get('attribute_catalogue/getAttributeId',[ProductController::class,'create'])->name('product.getAttributeId');
Route::get('ajax/attribute/getAttribute', [AjaxAttributeController::class, 'getAttribute'])->name('ajax.attribute.getAttribute');
Route::get('payment/ajax/location/getLocation', [LocationController::class, 'getLocation'])->name('ajax.payment.location.getLocation');


Route::get('user/ajax/location/getLocation',[LocationController::class,'getLocation'])->name('ajax.location.getLocation');
Route::get('user/edit/ajax/location/getLocation',[LocationController::class,'getLocation'])->name('ajax.location.getLocation');
Route::post('user/ajax/dashboard/changeStatus',[AjaxController::class,'changeStatus'])->name('ajax.change.status');
Route::get('attribute_catalogue/getAttributeId',[ProductController::class,'create'])->name('product.getAttributeId');
Route::get('ajax/attribute/getAttribute', [AjaxAttributeController::class, 'getAttribute'])->name('ajax.attribute.getAttribute');



Route::group(['prefix'=>'order/'],function (){
   Route::get('index',[OrderController::class,'index'])->name('order.index')->middleware(AuthenticateMiddleware::class);
   Route::get('detail/{id}',[OrderController::class,'detail'])->name('order.detail')->middleware(AuthenticateMiddleware::class);
   Route::post('accept/{id}',[OrderController::class,'accept'])->name('order.accept')->middleware(AuthenticateMiddleware::class);
   Route::delete('/destroy/{id}',[OrderController::class,'destroy'])->name('order.destroy')->middleware(AuthenticateMiddleware::class);
});


Route::group(['prefix'=>'attributecatalogue/'],function ()
{
    Route::get('index',[AttributeCatalogueController::class,'index'])->name('attributecatalogue.index')->middleware(AuthenticateMiddleware::class);
    Route::get('create',[AttributeCatalogueController::class,'create'])->name('attributecatalogue.create')->middleware(AuthenticateMiddleware::class);
    Route::post('store',[AttributeCatalogueController::class,'store'])->name('attributecatalogue.store')->middleware(AuthenticateMiddleware::class);
    Route::get('edit/{id}',[AttributeCatalogueController::class,'edit'])->name('attributecatalogue.edit')->middleware(AuthenticateMiddleware::class);
    Route::put('update/{id}',[AttributeCatalogueController::class,'update'])->name('attributecatalogue.update')->middleware(AuthenticateMiddleware::class);
    Route::get('delete/{id}',[AttributeCatalogueController::class,'delete'])->name('attributecatalogue.delete')->middleware(AuthenticateMiddleware::class);
    Route::delete('destroy/{id}',[AttributeCatalogueController::class,'destroy'])->name('attributecatalogue.destroy')->middleware(AuthenticateMiddleware::class);
});
Route::group(['prefix'=>'attribute/'],function (){

    Route::get('index',[AttributeController::class,'index'])->name('attribute.index')->middleware(AuthenticateMiddleware::class);
    Route::get('create',[AttributeController::class,'create'])->name('attribute.create')->middleware(AuthenticateMiddleware::class);
    Route::post('store',[AttributeController::class,'store'])->name('attribute.store')->middleware(AuthenticateMiddleware::class);
    Route::get('edit/{id}',[AttributeController::class,'edit'])->name('attribute.edit')->middleware(AuthenticateMiddleware::class);
    Route::put('update/{id}',[AttributeController::class,'update'])->name('attribute.update')->middleware(AuthenticateMiddleware::class);
    Route::get('delete/{id}',[AttributeController::class,'delete'])->name('attribute.delete')->middleware(AuthenticateMiddleware::class);
    Route::delete('destroy/{id}',[AttributeController::class,'destroy'])->name('attribute.destroy')->middleware(AuthenticateMiddleware::class);
});
Route::group(['prefix'=>'product/'],function (){

    Route::get('index',[ProductController::class,'index'])->name('product.index')->middleware(AuthenticateMiddleware::class);
    Route::get('create',[ProductController::class,'create'])->name('product.create')->middleware(AuthenticateMiddleware::class);
    Route::post('store',[ProductController::class,'store'])->name('product.store')->middleware(AuthenticateMiddleware::class);
    Route::get('edit/{id}',[ProductController::class,'edit'])->name('product.edit')->middleware(AuthenticateMiddleware::class);
    Route::put('update/{id}',[ProductController::class,'update'])->name('product.update')->middleware(AuthenticateMiddleware::class);
    Route::get('delete/{id}',[ProductController::class,'delete'])->name('product.delete')->middleware(AuthenticateMiddleware::class);
    Route::delete('destroy/{id}',[ProductController::class,'destroy'])->name('product.destroy')->middleware(AuthenticateMiddleware::class);

});
Route::group(['prefix'=>'category/'],function (){

    Route::get('index',[CategoryController::class,'index'])->name('category.index')->middleware(AuthenticateMiddleware::class);
    Route::get('create',[CategoryController::class,'create'])->name('category.create')->middleware(AuthenticateMiddleware::class);
    Route::post('store',[CategoryController::class,'store'])->name('category.store')->middleware(AuthenticateMiddleware::class);
    Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category.edit')->middleware(AuthenticateMiddleware::class);
    Route::put('update/{id}',[CategoryController::class,'update'])->name('category.update')->middleware(AuthenticateMiddleware::class);
    Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category.delete')->middleware(AuthenticateMiddleware::class);
    Route::delete('destroy/{id}',[CategoryController::class,'destroy'])->name('category.destroy')->middleware(AuthenticateMiddleware::class);

});

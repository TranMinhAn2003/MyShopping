<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostCatalogueController;
use App\Http\Controllers\WriteController;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Middleware\LoginMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/',[AuthController::class,'index'])->name('index')->middleware(LoginMiddleware::class);

Route::post('login',[AuthController::class,'login'])->name('login');
Route::get('logout',[AuthController::class,'logout'])->name('logout');
Route::get('dashboard/index',[DashboardController::class,'index'])->name('dashboard.index')->middleware(AuthenticateMiddleware::class);
Route::group([ 'prefix'=>'user'],function ()
{
    Route::get('index',[UserController::class,'index'])->name('user.index')->middleware(AuthenticateMiddleware::class);
    Route::get('create',[UserController::class,'create'])->name('user.create')->middleware(AuthenticateMiddleware::class);
    Route::post('store',[UserController::class,'store'])->name('user.store')->middleware(AuthenticateMiddleware::class);
    Route::get('edit/{id}',[UserController::class,'edit'])->name('user.edit')->middleware(AuthenticateMiddleware::class);
    Route::put('update/{id}',[UserController::class,'update'])->name('user.update')->middleware(AuthenticateMiddleware::class);
    Route::get('delete/{id}',[UserController::class,'delete'])->name('user.delete')->middleware(AuthenticateMiddleware::class);
    Route::delete('destroy/{id}',[UserController::class,'destroy'])->name('user.destroy')->middleware(AuthenticateMiddleware::class);

});Route::group([ 'prefix'=>'post'],function ()
{
    Route::get('index',[PostCatalogueController::class,'index'])->name('postCatalogue.index')->middleware(AuthenticateMiddleware::class);
    Route::get('create',[PostCatalogueController::class,'create'])->name('postCatalogue.create')->middleware(AuthenticateMiddleware::class);
    Route::post('store',[PostCatalogueController::class,'store'])->name('postCatalogue.store')->middleware(AuthenticateMiddleware::class);
    Route::get('edit/{id}',[PostCatalogueController::class,'edit'])->name('postCatalogue.edit')->middleware(AuthenticateMiddleware::class);
    Route::put('update/{id}',[PostCatalogueController::class,'update'])->name('postCatalogue.update')->middleware(AuthenticateMiddleware::class);
    Route::get('delete/{id}',[PostCatalogueController::class,'delete'])->name('postCatalogue.delete')->middleware(AuthenticateMiddleware::class);
    Route::delete('destroy/{id}',[PostCatalogueController::class,'destroy'])->name('postCatalogue.destroy')->middleware(AuthenticateMiddleware::class);

});
Route::get('user/ajax/location/getLocation',[LocationController::class,'getLocation'])->name('ajax.location.getLocation');
Route::get('user/edit/ajax/location/getLocation',[LocationController::class,'getLocation'])->name('ajax.location.getLocation');
Route::post('user/ajax/dashboard/changeStatus',[AjaxController::class,'changeStatus'])->name('ajax.change.status');
Route::any('/ckfinder_2/connector', function() {
    include(base_path('ckfinder_2/core/connector/php/connector.php'));
})->name('ckfinder_connector');

Route::any('/ckfinder_2/browser', function() {
    return view('ckfinder.browser');
})->name('ckfinder_browser');
Route::get('/plugins/ckfinder_2/ckfinder.html', function() {
    $path = public_path('public/plugins/ckfinder_2/ckfinder.html');
    if (file_exists($path)) {
        return response()->file($path);
    } else {
        abort(404, 'File not found');
    }
});

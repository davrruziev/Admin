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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');
Route::group([
    'middleware' => 'auth'
], function (){
   Route::group([
       'prefix' => 'post',
       'as' => 'post.'
   ], function (){
    Route::get('/', [\App\Http\Controllers\Admin\PostController::class, 'index'])->name('index');
    Route::get('/create', [\App\Http\Controllers\Admin\PostController::class, 'create'])->name('create');
    Route::post('/store', [\App\Http\Controllers\Admin\PostController::class, 'store'])->name('store');
    Route::get('/edit/{post}', [\App\Http\Controllers\Admin\PostController::class, 'edit'])->name('edit');
    Route::post('/update/{post}', [\App\Http\Controllers\Admin\PostController::class, 'update'])->name('update');
    Route::post('/delete/{post}', [\App\Http\Controllers\Admin\PostController::class, 'delete'])->name('delete');
   });

    Route::resource('users', \App\Http\Controllers\Admin\UsersController::class)->middleware('role:admin,manager');
    Route::resource('roles', \App\Http\Controllers\Admin\RolesController::class)->middleware('can:isAdmin');
    Route::resource('permissions', \App\Http\Controllers\Admin\PermissionsController::class);

});

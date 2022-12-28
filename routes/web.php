<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;

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

//index routes
Route::get('/',[IndexController::class,'index'])->name('home');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//admin routes
Route::group(['prefix'=>'admin','middleware'=>['auth','verified','role:admin|developer']],function(){
    Route::get('dashboard',[AdminController::class,'dashboard'])->name('admin-dashboard');
});

//user routes
Route::group(['prefix'=>'user','middleware'=>['auth','verified']],function(){
    Route::get('dashboard',[UserController::class,'dashboard'])->name('user-dashboard');
});


Route::get('/dashboard', function () {
    if(auth()->user()->hasRole('admin') | auth()->user()->hasRole('developer')){
        return redirect()->route('admin-dashboard');
    }
    if(auth()->user()->hasRole('user')){
        return redirect()->route('user-dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';

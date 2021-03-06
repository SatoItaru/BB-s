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

Route::resource('/threads', 'App\Http\Controllers\ThreadController')->except(['update','create'])->middleware(['auth']);
Route::resource('/threads/{thread}/messages', 'App\Http\Controllers\MessageController')->except(['update','create'])->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('admin')->name('admin.')->group(function(){

    Route::get('/dashboard', function () {
        return view('admin.auth.dashboard');
    })->middleware(['auth:admin'])->name('dashboard');

    Route::resource('/threads', 'App\Http\Controllers\Admin\Auth\AdminThreadController')->except(['update','create','store'])->middleware(['auth:admin']);

    Route::resource('/threads/{thread}/messages', 'App\Http\Controllers\Admin\Auth\AdminMessageController')->only(['destroy'])->middleware(['auth:admin']);

    require __DIR__.'/admin.php';
});

Route::prefix('admin')->name('admin.')->group(function(){
    require __DIR__.'/admin.php';
});

require __DIR__.'/auth.php';

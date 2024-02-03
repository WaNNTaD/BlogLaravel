<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
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
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/login', [AuthController::class, 'check'])->name('auth.check');


Route::prefix('blog')->name('blog.')->controller(BlogController::class)->group(function () {

    Route::get('/', 'index')->name('index');
    Route::get('/{slug}-{article}', 'show')->where(['slug' => '[a-z0-9]+(?:-[a-z0-9]+)*', 'article' => '[0-9]+'])->name('show');
    Route::get('/new', 'new')->name('new')->middleware('auth');
    Route::post('/new', 'create')->name('create')->middleware('auth');
    Route::get('/modify/{slug}-{article}', 'modify')->where(['slug' => '[a-z0-9]+(?:-[a-z0-9]+)*', 'article' => '[0-9]+'])->name('modify')->middleware('auth');
    Route::post('/modify/{slug}-{article}', 'update')->where(['slug' => '[a-z0-9]+(?:-[a-z0-9]+)*', 'article' => '[0-9]+'])->name('update')->middleware('auth');
});

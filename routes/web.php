<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SpecieController;
use App\Http\Controllers\SpeciesController;
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
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('login', [AuthController::class, 'login']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', [HomeController::class, 'index']);


Route::get('/species', [App\Http\Controllers\SpecieController::class, 'index'])->name('species');
Route::resource('species',SpecieController::class);

Route::prefix('error')->group(function () {
    Route::get('/404', function () {
        return view('error/404');
    });
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('users');

    Route::resource('users', UsersController::class);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

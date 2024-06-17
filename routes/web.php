<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VaccineController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpecieController;
use App\Http\Controllers\ShelterController;
use App\Http\Controllers\ShelterMemberController;
use App\Http\Controllers\AnimalController;


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

Route::prefix('error')->group(function () {
    Route::get('/404', function () {
        return view('error/404');
    });
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::resource('users', UserController::class);

    Route::get('/users', [UserController::class, 'index'])->middleware('can:ver usuario')->name('users.index');


    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    Route::get('/species', [App\Http\Controllers\SpecieController::class, 'index'])->name('species');
    Route::resource('species',SpecieController::class);

    Route::resource('roles', RoleController::class);

    Route::post('/users/{user}/updateRole', [UserController::class, 'updateRole'])->name('users.updateRole'); 
    
    Route::get('/godfather', [ShelterMemberController::class, 'godfatherIndex'])->name('shelterMembers.godfather');
    Route::get('/adopter', [ShelterMemberController::class, 'adopterIndex'])->name('shelterMembers.adopter');
    Route::get('/donor', [ShelterMemberController::class, 'donorIndex'])->name('shelterMembers.donor');
    Route::get('/staff', [ShelterMemberController::class, 'staffIndex'])->name('shelterMembers.staff');
    Route::resource('shelterMember',ShelterMemberController::class);

    Route::get('/animals', [AnimalController::class, 'index'])->name('animals.index');
    Route::resource('animals', AnimalController::class);

  
});

Route::get('/vaccines', [App\Http\Controllers\VaccineController::class, 'index'])->name('vaccines');

Route::resource('vaccines', VaccineController::class);
Route::post('login', [AuthController::class, 'login']);



Route::get('/shelters', [ShelterController::class, 'shelters.index'])->name('shelters');

Route::resource('shelters', ShelterController::class);

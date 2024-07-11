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
use App\Http\Controllers\SponsorshipController;
use App\Http\Controllers\DeathController;
use App\Http\Controllers\VetAppointmentController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\RefugeController;


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

Route::get('refuges', [RefugeController::class, 'index']);

Route::prefix('error')->group(function () {
    Route::get('/404', function () {
        return view('error/404');
    });
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::resource('users', UserController::class)->middleware('can:viewUser');

    Route::get('/species', [SpecieController::class, 'index'])->name('species');
    Route::resource('species',SpecieController::class)->middleware('can:viewSpecie');

    Route::resource('roles', RoleController::class)->middleware('can:viewRol');

    Route::post('/users/{user}/updateRole', [UserController::class, 'updateRole'])->middleware('can:viewUser')->name('users.updateRole');
  
    Route::get('/godfather', [ShelterMemberController::class, 'godfatherIndex'])->name('shelterMembers.godfather');
    Route::get('/adopter', [ShelterMemberController::class, 'adopterIndex'])->name('shelterMembers.adopter');
    Route::get('/donor', [ShelterMemberController::class, 'donorIndex'])->name('shelterMembers.donor');
    Route::get('/staff', [ShelterMemberController::class, 'staffIndex'])->name('shelterMembers.staff');
    Route::resource('shelterMember',ShelterMemberController::class);
 
    Route::post('sponsorship', [SponsorshipController::class, 'store'])->name('sponsorship.store');
    Route::resource('sponsorship',SponsorshipController::class);

    Route::get('/animals', [AnimalController::class, 'index'])->name('animals.index');
    Route::resource('animals', AnimalController::class)->middleware('can:viewAnimal');

    Route::get('/animals/petProfile/{animalId}', [AnimalController::class, 'petProfile'])->name('animals.petProfile');
  
    Route::get('/vaccines', [VaccineController::class, 'index'])->name('vaccines');
    Route::resource('vaccines', VaccineController::class)->middleware('can:viewVaccine');

    Route::get('/shelters', [ShelterController::class, 'shelters.index'])->name('shelters');
    Route::resource('shelters', ShelterController::class)->middleware('can:viewShelter');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/vetAppointments', [VetAppointmentController::class, 'vetAppointments.index'])->name('vetAppointments');
    Route::resource('vetAppointments', VetAppointmentController::class);

    Route::get('/deaths', [DeathController::class, 'index'])->name('deaths');
    Route::resource('deaths', DeathController::class);

    Route::get('/adoptions/pdfAdoption/{id}', [AdoptionController::class, 'pdfAdoption'])->name('adoptions.pdfAdoption');
    Route::resource('adoptions', AdoptionController::class)->except(['index']);

});

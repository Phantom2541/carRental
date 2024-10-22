<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\RentalsController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware('users')->group(function () {
//     Route::get('/', [UserController::class, 'index'])->name('users.index');
//     Route::post('/store', [UserController::class, 'store'])->name('users.store');
//     Route::get('/edit', [UserController::class, 'edit'])->name('users.edit');
//     Route::patch('/update', [UserController::class, 'update'])->name('users.update');
//     Route::delete('/delete', [UserController::class, 'destroy'])->name('users.destroy');
// });

// Route::get('/users', [UsersController::class, 'index'])->name('users.index');
// Route::resource('users', UsersController::class);
Route::resource('users', UserController::class);
Route::resource('cars', CarsController::class);
Route::resource('rentals', RentalsController::class);
Route::post('rentals/{id}/approve', [RentalsController::class, 'approve'])->name('rentals.approve');


require __DIR__.'/auth.php';

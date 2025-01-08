<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\VehicleController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


//User
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->middleware('user');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::get('vehicle',[VehicleController::class,'index'])->name('vehicle');
Route::get('vehicle/add',[VehicleController::class,'create'])->name('vehicle.add');
Route::delete('/delete/{vehicle}',[VehicleController::class,'destroy'])->name('vehicle.delete');
Route::post('/delete',[VehicleController::class,'deletedAll'])->name('vehicles.delete');





Route::get('driver',[DriverController::class,'index'])->name('driver');

Route::get('location',[LocationController::class,'index'])->name('location');

require __DIR__.'/auth.php';

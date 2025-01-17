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

Route::middleware('auth')->group(function() {
    Route::get('vehicle',[VehicleController::class,'index'])->name('vehicle');
    Route::get('vehicle/create',[VehicleController::class,'create'])->name('vehicle.create');
    Route::post('vehicle/store',[VehicleController::class,'store'])->name('vehicle.store');
    Route::get('vehicle/edit',[VehicleController::class,'edit'])->name('vehicle.edit');
    Route::put('vehicle/{vehicle}',[VehicleController::class,'update'])->name('vehicle.update');
    Route::delete('/delete/{vehicle}',[VehicleController::class,'destroy'])->name('vehicle.delete');
    Route::get('/vehicle/{vehicle}',[VehicleController::class,'show'])->name('vehicle.show');
    Route::post('/delete',[VehicleController::class,'deletedAll'])->name('vehicles.delete');
    Route::post('/image/upload',[VehicleController::class,'upload'])->name('vehicles.upload');
});


Route::get('driver',[DriverController::class,'index'])->name('driver');
Route::get('driver/create',[DriverController::class,'create'])->name('driver.create');

Route::get('location',[LocationController::class,'index'])->name('location');

require __DIR__.'/auth.php';

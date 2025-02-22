<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FuelRecordController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\RouteController;
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

// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','verified'])->group(function( ) {
    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('vehicle')->group(function () {
    Route::get('/', [VehicleController::class, 'index'])->name('vehicle');
    Route::get('/create', [VehicleController::class, 'create'])->name('vehicle.create');
    Route::post('/store', [VehicleController::class, 'store'])->name('vehicle.store');
    Route::get('/edit', [VehicleController::class, 'edit'])->name('vehicle.edit');
    Route::put('/{vehicle}', [VehicleController::class, 'update'])->name('vehicle.update');
    Route::delete('/delete/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicle.delete');
    Route::get('/detail/{vehicle}', [VehicleController::class, 'show'])->name('vehicle.show');
    Route::post('/delete-all', [VehicleController::class, 'deletedAll'])->name('vehicles.delete');
    Route::post('/image/upload', [VehicleController::class, 'upload'])->name('vehicles.upload');
});

Route::middleware('auth')->prefix('driver')->group(function () {
    Route::get('/', [DriverController::class, 'index'])->name('driver');
    Route::get('/create', [DriverController::class, 'create'])->name('driver.create');
    Route::post('/store', [DriverController::class, 'store'])->name('driver.store');
    Route::put('/{driver}', [DriverController::class, 'update'])->name('driver.update');
    Route::delete('/delete/{driver}', [DriverController::class, 'destroy'])->name('driver.delete');
    Route::get('/detail/{driver}', [DriverController::class, 'show'])->name('driver.show');
    Route::post('/delete-all', [DriverController::class, 'deletedAll'])->name('drivers.delete');
    Route::post('/status', [DriverController::class, 'status'])->name('driver.status');

});

Route::middleware('auth')->prefix('location')->group(function () {
    Route::get('/', [LocationController::class,'index'])->name('location');
    Route::get('/create', [LocationController::class,'create'])->name('location.create');
    Route::post('/store', [LocationController::class,'store'])->name('location.store');
    Route::put('/{location}', [LocationController::class,'update'])->name('location.update');
    Route::delete('/delete/{location}', [LocationController::class, 'destroy'])->name('location.delete');
    Route::post('/delete-all', [LocationController::class, 'deletedAll'])->name('locations.delete');

});

Route::middleware('auth')->prefix('route')->group(function () {
    Route::get('/', [RouteController::class,'index'])->name('route');
    Route::get('/create', [RouteController::class,'create'])->name('route.create');
    Route::post('/store', [RouteController::class,'store'])->name('route.store');
    Route::get('/detail/{route}', [RouteController::class, 'show'])->name('route.show');
    Route::put('/{route}', [RouteController::class,'update'])->name('route.update');

});

Route::middleware('auth')->prefix('fuel')->group(function () {
    Route::get('/', [FuelRecordController::class,'index'])->name('fuel');
    Route::get('/create', [FuelRecordController::class,'create'])->name('fuel.create');
    Route::post('/store', [FuelRecordController::class,'store'])->name('fuel.store');

});

require __DIR__.'/auth.php';

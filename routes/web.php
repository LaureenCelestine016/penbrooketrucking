<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\FuelRecordController;
use App\Http\Controllers\GPSController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MaintenanceTaskController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TrailerController;
use App\Http\Controllers\TruckRegistrationController;
use App\Http\Controllers\ChatController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;




    Route::get('/
    ', function () {
        return redirect()->route('login');
    })->middleware('PreventBackHistory');

    Route::middleware(['auth','verified'])->group(function () {
        Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::middleware('auth', 'check.vehicle.expiration')->prefix('vehicle')->group(function () {
        Route::get('/', [VehicleController::class, 'index'])->name('vehicle');
        Route::get('/getstatus', [VehicleController::class, 'filter'])->name('vehicle.filter');
        Route::get('/create', [VehicleController::class, 'create'])->name('vehicle.create');
        Route::post('/store', [VehicleController::class, 'store'])->name('vehicle.store');
        Route::get('/edit', [VehicleController::class, 'edit'])->name('vehicle.edit');
        Route::put('/{vehicle}', [VehicleController::class, 'update'])->name('vehicle.update');
        Route::delete('/delete/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicle.delete');
        Route::get('/detail/{vehicle}', [VehicleController::class, 'show'])->name('vehicle.show');
        Route::post('/delete-all', [VehicleController::class, 'deletedAll'])->name('vehicles.delete');
        Route::post('/image/upload', [VehicleController::class, 'upload'])->name('vehicles.upload');
    });

    Route::middleware('auth', 'check.trailer.expiration')->prefix('trailer')->group(function () {
        Route::get('/', [TrailerController::class, 'index'])->name('trailer');
        Route::get('/create', [TrailerController::class, 'create'])->name('trailer.create');
        Route::post('/store', [TrailerController::class, 'store'])->name('trailer.store');
        Route::post('/delete-all', [TrailerController::class, 'deletedAll'])->name('trailers.delete');
        Route::delete('/delete/{trailer}', [TrailerController::class, 'destroy'])->name('trailer.delete');
        Route::get('/detail/{trailer}', [TrailerController::class, 'show'])->name('trailer.show');
        Route::put('/{trailer}', [TrailerController::class, 'update'])->name('trailer.update');
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
        Route::get('/rides', [DriverController::class, 'rides'])->name('driver.rides');
        Route::get('/routes', [DriverController::class, 'routes'])->name('driver.routes');
        Route::get('/profile', [DriverController::class, 'profile'])->name('driver.profile');
        Route::post('/userupdate', [DriverController::class, 'userupdate'])->name('driver.userupdate');
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
        Route::delete('/delete/{route}', [RouteController::class, 'destroy'])->name('route.delete');
        Route::post('/delete-all', [RouteController::class, 'deletedAll'])->name('routes.delete');
    });

    Route::middleware('auth')->prefix('fuel')->group(function () {
        Route::get('/', [FuelRecordController::class,'index'])->name('fuel');
        Route::get('/create', [FuelRecordController::class,'create'])->name('fuel.create');
        Route::post('/store', [FuelRecordController::class,'store'])->name('fuel.store');
        Route::put('/{fuel_record}', [FuelRecordController::class,'update'])->name('fuel.update');
        Route::delete('/delete/{fuel_record}', [FuelRecordController::class, 'destroy'])->name('fuel.delete');
        Route::post('/delete-all', [FuelRecordController::class, 'deletedAll'])->name('fuels.delete');
    });

    Route::middleware('auth')->prefix('maintenance')->group(function () {
        Route::get('/', [MaintenanceTaskController::class,'index'])->name('maintenance');
        Route::get('/create', [MaintenanceTaskController::class,'create'])->name('maintenance.create');
        Route::post('/store', [MaintenanceTaskController::class,'store'])->name('maintenance.store');
        Route::delete('/delete/{maintenance_task}', [MaintenanceTaskController::class, 'destroy'])->name('maintenance.delete');
        Route::post('/delete-all', [MaintenanceTaskController::class, 'deletedAll'])->name('maintenances.delete');
    });

    Route::middleware('auth')->prefix('expenses')->group(function () {
        Route::get('/', [ExpensesController::class,'index'])->name('expenses');
        Route::get('/create', [ExpensesController::class,'create'])->name('expenses.create');
        Route::post('/store', [ExpensesController::class,'store'])->name('expenses.store');
        Route::delete('/delete/{expenses}', [ExpensesController::class, 'destroy'])->name('expenses.delete');
        Route::post('/delete-all', [ExpensesController::class, 'deletedAll'])->name('expensess.delete');
    });

    Route::middleware('auth')->prefix('registration')->group(function () {
        Route::get('/', [TruckRegistrationController::class,'index'])->name('registration');
        Route::get('/create', [TruckRegistrationController::class,'create'])->name('registration.create');
        Route::post('/store', [TruckRegistrationController::class,'store'])->name('registration.store');
        Route::put('/{id}', [TruckRegistrationController::class,'update'])->name('registration.update');
    });

    Route::middleware('auth')->prefix('notification')->group(function () {
        Route::patch('/notification/update/{id}', [NotificationController::class, 'updateStatus'])
             ->name('notification.update');
    });

    Route::middleware('auth')->prefix('reports')->group(function () {
        Route::get('/route', [ReportController::class,'index'])->name('reports.route');
        Route::get('/routefilter', [ReportController::class,'routefilter'])->name('reports.routesfilter');
        Route::get('/fuel', [ReportController::class,'reportfuel'])->name('reports.fuel');
        Route::get('/fuelFilter', [ReportController::class,'filterFuelReports'])->name('reports.fuelfilter');
        Route::get('/maintenance', [ReportController::class,'reportmaintenance'])->name('reports.maintenance');
        Route::get('/maintenanceFilter', [ReportController::class,'filterMaintenanceReports'])->name('reports.maintenancefilter');
        Route::get('/expenses', [ReportController::class,'reportexpenses'])->name('reports.expenses');
        Route::get('/expensesFilter', [ReportController::class,'filterExpensesReports'])->name('reports.expensesfilter');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/chat/{receiverId}', [ChatController::class, 'index'])->name('chat.index');
        Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
        Route::get('/chat/messages/{receiverId}', [ChatController::class, 'fetchMessages'])->name('chat.fetch');
    });

    Route::get('/api/gps-data', [GPSController::class,'store']);


// User login route with redirection if authenticated and cache control headers.


require __DIR__.'/auth.php';

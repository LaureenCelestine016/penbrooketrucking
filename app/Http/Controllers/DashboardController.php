<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Route;
use App\Models\Notification;
use App\Models\Maintenance_task;
use App\Models\Fuel_record;
use App\Models\Trailer;
use App\Models\User;
use App\Models\Driver;
use App\Models\Expenses;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $currentYear = date('Y');

        if ($user->user_type == 1) {
            // Count Vehicles & Trailers
            $trucks = collect([Vehicle::class, Trailer::class])
                ->sum(fn($model) => $model::count());

            $operationalCount = collect([Vehicle::class, Trailer::class])
                ->sum(fn($model) => $model::where('status', 'Operational')->count());

            $nonOperationalCount = collect([Vehicle::class, Trailer::class])
                ->sum(fn($model) => $model::where('status', 'Non-Operational')->count());

            $maintenance = collect([Vehicle::class, Trailer::class])
                ->sum(fn($model) => $model::where('status', 'Maintenance')->count());

            $driver = Driver::count();
            $maintenanceTotal = Maintenance_task::sum('total');

            // Get yearly maintenance costs
            $yearlyCosts = Maintenance_task::select(
                    DB::raw("YEAR(breakdown_date) as year"),
                    DB::raw("SUM(total) as total_cost")
                )
                ->groupBy('year')
                ->orderBy('year', 'ASC')
                ->get();

            // Default monthly maintenance costs for the current year
            $maintenanceCosts = $this->getMaintenanceDataByYear($currentYear);

            // Fetch Yearly Expenses
            $yearlyExpenses = Expenses::select(
                DB::raw("YEAR(expense_date) as year"),
                DB::raw("SUM(amount) as total_cost")
            )
            ->groupBy('year')
            ->orderBy('year', 'ASC')
            ->get();

            // Default Monthly Expenses for the current year
            $expensesData = $this->getExpensesDataByYear($currentYear);

            return Inertia::render('Dashboard', [
                'truck' => $trucks,
                'driver' => $driver,
                'maintenanceTotal' => $maintenanceTotal,
                'operationalData' => [
                    'operationalCount' => $operationalCount,
                    'nonOperationalCount' => $nonOperationalCount,
                    'maintenance' => $maintenance,
                ],
                'yearlyData' => $yearlyCosts, // Yearly maintenance costs
                'maintenanceData' => $maintenanceCosts, // Default to current year
                'selectedYear' => $currentYear, // Default selected year
                'yearlyExpenses' => $yearlyExpenses, // Yearly expenses
                'expensesData' => $expensesData, // Default monthly expenses
            ]);
        } else {
            $driverId = $user->driver_id;

            return Inertia::render('Dashboard', [
                'assignedRides' => Route::where('driver_id', $driverId)->where('status', 'Yet to start')->count(),
                'ongoingRides' => Route::where('driver_id', $driverId)->where('status', 'Ongoing')->count(),
                'completedRides' => Route::where('driver_id', $driverId)->where('status', 'Completed')->count(),
                'cancelledRide' => Route::where('driver_id', $driverId)->where('status', 'Cancelled')->count(),
                'driverTruckUsed' => Route::where('driver_id', $driverId)->where('status', 'Completed')->get(),
            ]);
        }
    }

    // Fetch maintenance data by year
    private function getMaintenanceDataByYear($year)
    {
        return Maintenance_task::select(
                DB::raw("YEAR(breakdown_date) as year"),
                DB::raw("MONTH(breakdown_date) as month"),
                DB::raw("SUM(total) as total_cost")
            )
            ->whereYear('breakdown_date', $year)
            ->groupBy('year', 'month')
            ->orderBy('month', 'ASC')
            ->get();
    }

    // API to fetch maintenance costs for a selected year
    public function getMaintenanceCosts(Request $request)
    {
        $year = $request->query('year', date('Y'));
        $maintenanceCosts = $this->getMaintenanceDataByYear($year);

        return response()->json(['maintenanceData' => $maintenanceCosts]);
    }

    // Fetch expenses data by year
    private function getExpensesDataByYear($year)
    {
        return Expenses::select(
                DB::raw("YEAR(expense_date) as year"),
                DB::raw("MONTH(expense_date) as month"),
                DB::raw("SUM(amount) as total_cost")
            )
            ->whereYear('expense_date', $year)
            ->groupBy('year', 'month')
            ->orderBy('month', 'ASC')
            ->get();
    }

    // API to fetch expenses for a selected year
    public function getExpensesByYear(Request $request)
    {
        $year = $request->query('year', date('Y'));
        $expensesData = $this->getExpensesDataByYear($year);

        return response()->json(['expensesData' => $expensesData]);
    }
}

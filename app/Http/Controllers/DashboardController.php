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
        $lastYear = $currentYear - 1;
        $currentMonth = (int) date('m'); // ← fix here


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
            $expensesData = $this->getCombinedExpensesDataByYear($currentYear);

            $litersByDriver = Fuel_record::join('drivers', 'fuel_records.driver_id', '=', 'drivers.id')
                ->select(
                    'drivers.id',
                    'drivers.last_name',
                    DB::raw('SUM(fuel_records.total_refuel) as total_liters')
                )
                ->groupBy('drivers.id', 'drivers.last_name')
                ->orderByDesc('total_liters')
                ->get();

            $litersPerMonth = Fuel_record::select(
                    DB::raw("MONTH(refueling_date) as month"),
                    DB::raw("SUM(total_refuel) as total_liters")
                )
                ->whereYear('refueling_date', date('Y'))
                ->groupBy(DB::raw("MONTH(refueling_date)"))
                ->orderBy(DB::raw("MONTH(refueling_date)"))
                ->get()
                ->map(function ($item) {
                    return [
                        'month' => date("F", mktime(0, 0, 0, $item->month, 1)),
                        'total_liters' => $item->total_liters,
                    ];
                });

            $lastYearYTD = Fuel_record::whereYear('refueling_date', $lastYear)
                ->sum('total_refuel');

            $currentYearYTD = Fuel_record::whereYear('refueling_date', $currentYear)
                ->sum('total_refuel');

            $totalGrowth = $lastYearYTD > 0
                ? round((($currentYearYTD - $lastYearYTD) / $lastYearYTD) * 100, 2)
                : null; // Avoid division by zero

            $sameMonthLastYear = Fuel_record::whereYear('refueling_date', $lastYear)
                ->whereMonth('refueling_date', $currentMonth)
                ->sum('total_refuel');



            $currentMonthRefuel = Fuel_record::whereYear('refueling_date', $currentYear)
                ->whereMonth('refueling_date', $currentMonth)
                ->sum('total_refuel');

            $monthlyGrowth = $currentMonthRefuel - $sameMonthLastYear;

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
                'litersByDriver' => $litersByDriver, // ✅ Add this line
                'litersPerMonth' => $litersPerMonth,
                'fuelStats' => [
                    'lastYearYTD' => $lastYearYTD,
                    'currentYearYTD' => $currentYearYTD,
                    'totalGrowth' => $totalGrowth,
                    'sameMonthLastYear' => $sameMonthLastYear,
                    'currentMonth' => $currentMonthRefuel,
                    'monthlyGrowth' => $monthlyGrowth,
                ],
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
    private function getCombinedExpensesDataByYear($year)
{
    // Vehicle expenses query using license_plate as the asset name
    $vehicleExpenses = DB::table('expenses')
        ->join('vehicles', 'expenses.vehicle_id', '=', 'vehicles.id')
        ->selectRaw('
            vehicles.id as asset_id,
            vehicles.license_plate as asset_name,
            MONTH(expense_date) as month,
            SUM(amount) as total_cost
        ')
        ->whereNotNull('expenses.vehicle_id')
        ->whereYear('expense_date', $year)
        ->groupBy('vehicles.id', 'vehicles.license_plate', DB::raw('MONTH(expense_date)'));

    // Trailer expenses query (assuming trailers also use license_plate; adjust if needed)
    $trailerExpenses = DB::table('expenses')
        ->join('trailers', 'expenses.trailer_id', '=', 'trailers.id')
        ->selectRaw('
            trailers.id + 10000 as asset_id,
            trailers.license_plate as asset_name,
            MONTH(expense_date) as month,
            SUM(amount) as total_cost
        ')
        ->whereNotNull('expenses.trailer_id')
        ->whereYear('expense_date', $year)
        ->groupBy('trailers.id', 'trailers.license_plate', DB::raw('MONTH(expense_date)'));

    // Combine both queries
    $combinedExpenses = $vehicleExpenses
        ->unionAll($trailerExpenses)
        ->orderBy('asset_name')
        ->get();

    return $combinedExpenses;
}


    // API to fetch expenses for a selected year
    public function getExpensesByYear(Request $request)
    {
        $year = $request->query('year', date('Y'));
        $expensesData = $this->getCombinedExpensesDataByYear($year);

        return response()->json(['expensesData' => $expensesData]);
    }
}

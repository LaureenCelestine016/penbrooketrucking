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
use Carbon\Carbon;
use App\Models\RegistrationKey;
use Illuminate\Support\Str;

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
            $fuelTotal = Fuel_record::sum('amount');

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

            $driversUser = User::where('user_type', 0)->get(['driver_id','first_name','last_name']);

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

            // Safely calculate total growth percentage
            $totalGrowth = null;
            if ($lastYearYTD > 0) {
                $totalGrowth = round((($currentYearYTD - $lastYearYTD) / $lastYearYTD) * 100, 2);
            } elseif ($currentYearYTD > 0) {
                // If there's no data last year but some this year, define it as 100% growth
                $totalGrowth = 100;
            } else {
                $totalGrowth = 0; // No growth if both are zero
            }

            $sameMonthLastYear = Fuel_record::whereYear('refueling_date', $lastYear)
                ->whereMonth('refueling_date', $currentMonth)
                ->sum('total_refuel');

            $currentMonthRefuel = Fuel_record::whereYear('refueling_date', $currentYear)
                ->whereMonth('refueling_date', $currentMonth)
                ->sum('total_refuel');

// Safely calculate monthly growth percentage
            $monthlyGrowth = null;
            if ($sameMonthLastYear > 0) {
                $monthlyGrowth = round((($currentMonthRefuel - $sameMonthLastYear) / $sameMonthLastYear) * 100, 2);
            } elseif ($currentMonthRefuel > 0) {
                $monthlyGrowth = 100; // Considered 100% growth from 0
            } else {
                $monthlyGrowth = 0; // No growth if both are zero
            }

            $notification = Notification::where('status', 'pending')->get();
            $notificationCount = Notification::where('status', 'pending')->count();


            return Inertia::render('Dashboard', [
                'truck' => $trucks,
                'driver' => $driver,
                'chatDrivers' => $driversUser,
                'maintenanceTotal' => $maintenanceTotal,
                'fuelTotal' => $fuelTotal,
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
                'notification' => $notification,
                'notificationCount' => $notificationCount,
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

            $currentMonthStart = Carbon::now()->startOfMonth();
            $currentMonthEnd = Carbon::now()->endOfMonth();

            $lastMonthStart = Carbon::now()->subMonthNoOverflow()->startOfMonth();
            $lastMonthEnd = Carbon::now()->subMonthNoOverflow()->endOfMonth();

            $assignedRides = Route::where('driver_id', $driverId)->where('status', 'Yet to start')->count();

            $onGoingRides =  Route::where('driver_id', $driverId)->where('status', 'Ongoing')->count();

            $completeRides = Route::where('driver_id', $driverId)->where('status', 'Completed')->count();

            $cancelledRide =  Route::where('driver_id', $driverId)->where('status', 'Cancelled')->count();

            $driverTruckUsed = Route::with('vehicle', 'trailer', 'startLocation', 'endLocation')
            ->where('driver_id', $driverId)->where('status','Completed') // Filter by driver_id
            ->get();

            $lastYearYTD = Fuel_record::where('driver_id', $driverId)->whereYear('refueling_date', $lastYear)
            ->sum('total_refuel');

            $currentYearYTD = Fuel_record::where('driver_id', $driverId)->whereYear('refueling_date', $currentYear)
                ->sum('total_refuel');

            $totalFuel = Fuel_record::where('driver_id', $driverId)->sum('total_refuel');

            $lastMonthTotalFuel = Fuel_record::where('driver_id', $driverId)
                ->whereBetween('refueling_date', [$lastMonthStart, $lastMonthEnd])
                ->sum('total_refuel');

            $currentMonthTotalFuel = Fuel_record::where('driver_id', $driverId)
                ->whereBetween('refueling_date', [$currentMonthStart, $currentMonthEnd])
                ->sum('total_refuel');


            return Inertia::render('Dashboard', [
                'assignedRides' => $assignedRides,
                'ongoingRides' => $onGoingRides,
                'completedRides' => $completeRides ,
                'cancelledRide' => $cancelledRide,
                'driverTruckUsed' => $driverTruckUsed,
                'fuelStats' => [
                   'lastYearYTD' => $lastYearYTD,
                   'currentYearYTD' => $currentYearYTD,
                   'totalFuel' => $totalFuel,
                ],
                'lastCurrentMonth' => [
                    'lastMonthTotalFuel' => $lastMonthTotalFuel,
                    'currentMonthTotalFuel' => $currentMonthTotalFuel
                ]
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

    public function getFuelStats(Request $request)
    {

        $driverId = $request->get('driver_id') ?? Auth::user()->driver_id;
        $view = $request->get('view', 'monthly');
        $year = $request->get('year', now()->year);

        $query = Fuel_record::query();

        if ($driverId) {
            $query->where('driver_id', $driverId);
        }

        if ($view === 'yearly') {
            $stats = $query->selectRaw('YEAR(refueling_date) as year, SUM(total_refuel) as total_liters')
                ->groupBy('year')
                ->orderBy('year')
                ->get();
        } else {
            $stats = $query->whereYear('refueling_date', $year)
                ->selectRaw('MONTH(refueling_date) as month, SUM(total_refuel) as total_liters')
                ->groupBy('month')
                ->orderBy('month')
                ->get();
        }

        return response()->json([
            'fuelStats' => $stats,
        ]);
    }

    public function driverDashboard($driverId)
    {
        $currentYear = date('Y');
        $lastYear = $currentYear - 1;

        $driver = Driver::findOrFail($driverId); // 🚨 make sure driver exists

        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();
        $lastMonthStart = Carbon::now()->subMonthNoOverflow()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonthNoOverflow()->endOfMonth();

        $assignedRides = Route::where('driver_id', $driverId)->where('status', 'Yet to start')->count();
        $onGoingRides = Route::where('driver_id', $driverId)->where('status', 'Ongoing')->count();
        $completeRides = Route::where('driver_id', $driverId)->where('status', 'Completed')->count();
        $cancelledRide = Route::where('driver_id', $driverId)->where('status', 'Cancelled')->count();

        $driverTruckUsed = Route::with('vehicle', 'trailer', 'startLocation', 'endLocation')
            ->where('driver_id', $driverId)->where('status','Completed')->get();

        $lastYearYTD = Fuel_record::where('driver_id', $driverId)->whereYear('refueling_date', $lastYear)
            ->sum('total_refuel');

        $currentYearYTD = Fuel_record::where('driver_id', $driverId)->whereYear('refueling_date', $currentYear)
            ->sum('total_refuel');

        $totalFuel = Fuel_record::where('driver_id', $driverId)->sum('total_refuel');

        $lastMonthTotalFuel = Fuel_record::where('driver_id', $driverId)
            ->whereBetween('refueling_date', [$lastMonthStart, $lastMonthEnd])
            ->sum('total_refuel');

        $currentMonthTotalFuel = Fuel_record::where('driver_id', $driverId)
            ->whereBetween('refueling_date', [$currentMonthStart, $currentMonthEnd])
            ->sum('total_refuel');

        return Inertia::render('Dashboard/DriverDashboard', [ // <- create this view
            'driver' => $driver,
            'driver_id' => $driverId,
            'assignedRides' => $assignedRides,
            'ongoingRides' => $onGoingRides,
            'completedRides' => $completeRides ,
            'cancelledRide' => $cancelledRide,
            'driverTruckUsed' => $driverTruckUsed,
            'fuelStats' => [
            'lastYearYTD' => $lastYearYTD,
            'currentYearYTD' => $currentYearYTD,
            'totalFuel' => $totalFuel,
            ],
            'lastCurrentMonth' => [
                'lastMonthTotalFuel' => $lastMonthTotalFuel,
                'currentMonthTotalFuel' => $currentMonthTotalFuel
            ]
        ]);
    }

    public function generateKey()
    {

        $key = Str::upper(Str::random(10));

        $newKey = RegistrationKey::create([
            'key' => $key,
        ]);

        return response()->json(['key' => $newKey->key]);
    }

}



<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $operationalCount = Vehicle::where('status', 'Operational')->count();
        $nonOperationalCount = Vehicle::where('status', '!=', 'Operational')->count();

        return Inertia::render('Dashboard', [
            'operationalCount' => $operationalCount,
            'nonOperationalCount' => $nonOperationalCount
        ]);



    }




}

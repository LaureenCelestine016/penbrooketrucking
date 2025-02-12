<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Location;
use App\Models\Route;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Route/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return Inertia::render('Route/Create', [
            "vehicles" => Vehicle::with(['fuelRecords' => function ($query) {
                $query->orderBy('created_at', 'desc'); // Sort fuel records by latest first
            }])
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get(['id', 'name']), // Fetch only id and name

            "locations" => Location::get(['id', 'address']), // Fetch all locations with id and address

            "drivers" => Driver::selectRaw("id, CONCAT(first_name, ' ', last_name) AS fullname")
                ->orderBy('created_at', 'desc')
                ->get(), // Fetch drivers with full name concatenation
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Route $route)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        //
    }
}

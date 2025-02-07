<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Resources\LocationResource;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $location = LocationResource::collection(
            Location::orderBy('created_at', 'desc')->get()
        );

        return Inertia::render('Location/Index',['location' => $location]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Location/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'address'          => 'nullable|string|max:255',
            'region'           => 'required|string|max:255',
            'province'         => 'required|string|max:255',
            'city'             => 'nullable|string|max:255',
            'municipality'     => 'nullable|string|max:255',
            'barangay'         => 'required|string|max:255',
            'street'           => 'required|string|max:255',
            'name'             => 'required|string|max:255',
            'latitude'         => 'required|numeric|min:-90|max:90',
            'longitude'        => 'required|numeric|min:-180|max:180',
        ]);

        Location::create([
            'name'               => $validatedData['name'],
            'street'             => $validatedData['street'],
            'barangay'           => $validatedData['barangay'],
            'municipality'       => $validatedData['municipality'],
            'city'               => $validatedData['city'],
            'province'           => $validatedData['province'],
            'region'             => $validatedData['region'],
            'address'            => $validatedData['address'],
            'latitude'           => $validatedData['latitude'],
            'longitude'          => $validatedData['longitude'],
        ]);

        return redirect()->route('location')->with('success', 'Location created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        //
    }
}

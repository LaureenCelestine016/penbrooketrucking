<?php

namespace App\Http\Controllers;

use App\Models\TruckRegistration;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TruckRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Registration/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TruckRegistration $truckRegistration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TruckRegistration $truckRegistration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TruckRegistration $truckRegistration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TruckRegistration $truckRegistration)
    {
        //
    }
}

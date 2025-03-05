<?php

namespace App\Http\Controllers;

use App\Models\GPS;
use Illuminate\Http\Request;

class GPSController extends Controller
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
        //
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
    public function show(GPS $gPS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GPS $gPS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GPS $gPS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GPS $gPS)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Maintenance_task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MaintenanceTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Inertia::render('Maintenance/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Maintenance/Create');
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
    public function show(Maintenance_task $maintenance_task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance_task $maintenance_task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maintenance_task $maintenance_task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenance_task $maintenance_task)
    {
        //
    }
}

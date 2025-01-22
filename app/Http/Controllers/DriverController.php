<?php

namespace App\Http\Controllers;

use App\Http\Resources\DriverResource;
use App\Models\Driver;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $drivers = DriverResource::collection(
            Driver::orderBy('created_at', 'desc')->get()
        );

        return Inertia::render('Driver/Index',  ['drivers' => $drivers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Driver/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'firstName'           => 'required|string|max:255',
            'lastName'            => 'required|string|max:255',
            'civilStatus'         => 'required|string|max:255',
            'birthDay'            => 'required|string|max:255',
            'age'                 => 'required|numeric|min:18|max:99',
            'address'             => 'required|string|max:255',
            'contactNumber'       => ['required', 'regex:/^\+63[0-9]{10}$/'],
            'contactPerson'       => ['required', 'regex:/^\+63[0-9]{10}$/'],
            'philhealth_no'       => 'required|string|max:10',
            'pagibig_no'          => 'required|string|max:10',
            'sss_no'              => 'required|string|max:10',
            'tin_no'              => 'required|string|max:10',
            'license_number'      => 'required|string|max:11',
            // 'license_expired'     => 'required|string|max:11',
            'status'              => 'required|string|max:10',

        ]);

        Driver::create([
            'first_name'          => $validatedData['firstName'],
            'middle_name'         => $request->middleName,
            'last_name'           => $validatedData['lastName'],
            'civil_status'        => $validatedData['civilStatus'],
            'birthday'            => $validatedData['birthDay'],
            'address'             => $validatedData['address'],
            'contact_number'      => $validatedData['contactNumber'],
            'contact_person'      => $validatedData['contactPerson'],
            'age'                 => $validatedData['age'],
            'image'               => null,
            'pagibig_no'          => $validatedData['pagibig_no'],
            'philhealth_no'       => $validatedData['philhealth_no'],
            'sss_no'              => $validatedData['sss_no'],
            'tin_no'              => $validatedData['tin_no'],
            'license_number'      => $validatedData['license_number'],
            'license_expired'     => $request->license_expired,
            'status'              => $validatedData['status'],
        ]);

        return redirect()->route('driver')->with('success', 'Driver created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        //
    }
}

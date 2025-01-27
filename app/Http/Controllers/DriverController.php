<?php

namespace App\Http\Controllers;

use App\Http\Resources\DriverResource;
use App\Models\Driver;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Rules\AgeValidation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

        dd($request);
        $validatedData = $request->validate([
            'firstName'             => 'required|string|max:255',
            'lastName'              => 'required|string|max:255',
            'civilStatus'           => 'required|string|max:255',
            'birthDay'              => ['required', 'date', new AgeValidation(18)],
            'age'                   => 'required|numeric|min:18|max:99',
            'address'               => 'required|string|max:255',
            'contactNumber'         => ['required', 'regex:/^\+63[0-9]{10}$/'],
            'contactPerson'         => ['required', 'regex:/^\+63[0-9]{10}$/'],
            'philhealth_no'         => 'required|string|min:14|max:14',
            'pagibig_no'            => 'required|string|min:14|max:14',
            'sss_no'                => 'required|string|min:12|max:12',
            'tin_no'                => 'required|string|min:15|max:15',
            'license_number'        => 'required|string|min:13|max:13|unique:drivers,license_number',
            'license_expired'       => ['required', 'date', 'after:today'],
            'status'                => 'required|string|max:10',
            'username' => ['nullable', 'string', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::min(8)],

        ],[ 'license_number.unique' => 'The license number is already taken.']
        );

        try{
            DB::transaction(function () use ($validatedData, $request) {
                $driver = Driver::create([
                    'first_name' => $validatedData['firstName'],
                    'middle_name' => $request->middleName,
                    'last_name' => $validatedData['lastName'],
                    'civil_status' => $validatedData['civilStatus'],
                    'birthday' => Carbon::parse($validatedData['birthDay'])->format('Y-m-d'),
                    'address' => $validatedData['address'],
                    'contact_number' => $validatedData['contactNumber'],
                    'contact_person' => $validatedData['contactPerson'],
                    'age' => $validatedData['age'],
                    'image' => null,
                    'pagibig_no' => $validatedData['pagibig_no'],
                    'philhealth_no' => $validatedData['philhealth_no'],
                    'sss_no' => $validatedData['sss_no'],
                    'tin_no' => $validatedData['tin_no'],
                    'license_number' => $validatedData['license_number'],
                    'license_expired' => Carbon::parse($validatedData['license_expired'])->format('Y-m-d'),
                    'status' => $validatedData['status'],
                ]);

                User::create([
                    'first_name' => $validatedData['firstName'],
                    'last_name' => $validatedData['lastName'],
                    'mobile_number' => $validatedData['contactNumber'],
                    'username' => $validatedData['username'],
                    'email' => $request->email_address,
                    'user_type' => 0,
                    'driver_id' => $driver->id,
                    'password' => Hash::make($request->password),
                ]);
            });
        } catch (\Exception $e) {
            dd($e->getMessage());
        }



        return redirect()->route('driver')->with('success', 'Driver created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $driver = Driver::with('user')->findOrFail($id);

        return Inertia::render('Driver/Show', [
            'Driver' => $driver,            // The driver data
            'User' => $driver->user // The related user data
        ]);
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

        $driver->delete();

        return redirect()->route('driver');
    }

    public function deletedAll(Request $request)
    {
        $ids = $request->ids;
        Driver::whereIn('id', $ids)->delete();

        return redirect()->route('driver');
    }
}

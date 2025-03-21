<?php

namespace App\Http\Controllers;

use App\Http\Resources\DriverResource;
use App\Models\Driver;
use App\Models\Route;
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

        $validatedData = $request->validate([
            'firstName'             => 'required|string|max:255',
            'lastName'              => 'required|string|max:255',
            'civilStatus'           => 'required|string|max:255',
            'birthDay'              => ['required', 'date', new AgeValidation(18)],
            'age'                   => 'required|numeric|min:18|max:99',
            'address'               => 'required|string|max:255',
            'contactNumber'         => ['required', 'regex:/^\+63[0-9]{10}$/'],
            'contactNamePerson'     => 'required|string|max:255',
            'contactPerson'         => ['required', 'regex:/^\+63[0-9]{10}$/'],
            'relation'              => 'required|string|max:255',
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
                    'contact_person' => $validatedData['contactNamePerson'],
                    'contact_no_person' => $validatedData['contactPerson'],
                    'relation' => $validatedData['relation'],
                    'age' => $validatedData['age'],
                    'image' => null,
                    'pagibig_no' => $request->pagibig_no,
                    'philhealth_no' => $request->philhealth_no,
                    'sss_no' => $request->sss_no,
                    'tin_no' => $request->tin_no,
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

        $driverTruckUsed = Route::with('vehicle', 'trailer', 'startLocation', 'endLocation')
        ->where('driver_id', $id) // Filter by driver_id
        ->get();

        return Inertia::render('Driver/Show', [
            'Driver' => $driver,            // The driver data
            'User' => $driver->user, // The related user data
            'driverTruckUsed' => $driverTruckUsed
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

        $validatedData = $request->validate([
            'first_name'            => 'required|string|max:255',
            'middle_name'           => 'nullable|string|max:255',
            'last_name'             => 'required|string|max:255',
            'civil_status'          => 'required|string|max:255',
            'birthday'              => ['required', 'date', new AgeValidation(18)],
            'age'                   => 'required|numeric|min:18|max:99',
            'address'               => 'required|string|max:255',
            'contact_number'        => ['required', 'regex:/^\+63[0-9]{10}$/'],
            'contact_person'        => 'required|string|max:255',
            'contact_no_person'     => ['required', 'regex:/^\+63[0-9]{10}$/'],
            'relation'              => 'required|string|max:255',
            'philhealth_no'         => 'nullable|string|min:14|max:14',
            'pagibig_no'            => 'nullable|string|min:14|max:14',
            'sss_no'                => 'nullable|string|min:12|max:12',
            'tin_no'                => 'nullable|string|min:15|max:15',
            'license_number'        => 'required|string|min:13|max:13',
            'license_expired'       => ['required', 'date', 'after:today'],
            'status'                => 'required|string|max:10',

        ]
        );

        $driver->update($validatedData);

        return redirect()->route('driver.show', $driver);

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

    public function status(Request $request)
    {
        $status = DB::table('drivers')
                ->where('id', $request['id'])
                ->update(['status' => $request['status']]);
    }

    public function location(Request $request)
    {

        $region = 'https://psgc.cloud/api/regions';

    }

    public function rides()
    {
        $user = Auth::user();
        $driverId = $user->driver_id;

        // For demonstration, assume "rides" are the routes with status 'Ongoing' or 'Yet to start'
        $rides = Route::where('driver_id', $driverId)
            ->whereIn('status', ['Ongoing', 'Yet to start'])
            ->get();

        return Inertia::render('Driver/Rides', [
            'rides' => $rides,
        ]);
    }

    public function routes()
    {

        $user = Auth::user();
        $driverId = $user->driver_id; // Directly get authenticated user ID


        $routes = Route::with(['vehicle', 'trailer', 'startLocation', 'endLocation'])
                ->where('driver_id', $driverId)
                ->whereIn('status', ['Yet to start', 'Ongoing', 'Cancelled']) // Use whereIn for multiple status values
                ->get();

        return Inertia::render('Driver/Routes', [
            'routes' => $routes,
        ]);

    }

    public function profile()
    {

        $driverId = Auth::user()->driver_id; // Get the authenticated user's driver ID

        $driverProfile = Driver::with('user')->where('id', $driverId)->first(); // Fetch single record

        return Inertia::render('Driver/UserProfile', [
            'driverProfile' => $driverProfile, // Pass data to Inertia
        ]);

    }

    public function userupdate(Request $request)
    {
    // Validate the request
    $validatedData = $request->validate([
        'username' => 'sometimes|required|string|max:255',
        'password' => 'nullable|string|min:8|confirmed',
        'license_number' => 'sometimes|required|string|max:255',
        'license_expired' => 'sometimes|required|date',
    ]);

    // Get the authenticated user
    $user = Auth::user();
    $driver = $user->driver; // Assuming user has a related driver profile

    // Update username if provided
    if ($request->has('username')) {
        $user->username = $request->username;
    }

    // Only update password if provided
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    // Update driver's license details if provided
    if ($driver) {
        if ($request->has('license_number')) {
            $driver->license_number = $request->license_number;
        }
        if ($request->has('license_expired')) {
            $driver->license_expired = $request->license_expired;
        }
        $driver->save();
    }

    // Return success message with Inertia redirect
    return redirect()->route('driver.profile')->with('success', 'Profile updated successfully.');
    }
}

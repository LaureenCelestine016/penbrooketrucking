<?php

namespace App\Http\Controllers;

use App\Models\Fuel_record;
use App\Models\Maintenance_task;
use App\Models\Notification;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;


class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::orderBy('created_at', 'desc')->get();

        return Inertia::render('Vehicle/Index', ['Vehicles' => $vehicles]);
    }

    public function filter(Request $request)
    {
        $status = $request->query('status');

        $vehicles = Vehicle::when($status, function ($query) use ($status) {
            return $query->where('status', $status);
        })->get();

        return Inertia::render('Vehicle/Index', ['Vehicles' => $vehicles]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Vehicle/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    // Validate the incoming request

    $validatedData = $request->validate([
        'plateNumber'        => 'required|string|max:10|unique:vehicles,license_plate',
        'model'              => 'required|string|max:255',
        'capacity'           => 'required|integer',
        'status'             => 'required|string|max:50',
        'LTOregDate'         => 'nullable|date',
        'LTOExpDate'         => 'nullable|date',
        'conveyanceDate'     => 'nullable|date',
        'conveyanceExpDate'  => 'nullable|date',
        'filcomFabDate'      => 'nullable|date',
        'filconExpDate'      => 'nullable|date',
        'LTFRBRegDate'       => 'nullable|date',
        'LTFRBExpDate'       => 'nullable|date',
        'engineNumber'       => 'required|string|max:20|unique:vehicles,engine_number',
        'PMSRegDate'         => 'required|date',
        'PMSLastMileAge'     => 'required|string|max:255',
        'PMSCurrentReading'  => 'required|string|max:255',
        'consumeMileage'     => 'required|integer',
        'nextPMSMileage'     => 'required|integer',
    ]);

    // Create and save a new vehicle record
    Vehicle::create([
        'license_plate'                => $validatedData['plateNumber'],
        'model'                        => $validatedData['model'],
        'capacity'                     => $validatedData['capacity'],
        'status'                       => $validatedData['status'],
        'lto_reg_date'                 => $validatedData['LTOregDate'],
        'lto_exp_date'                 => $validatedData['LTOExpDate'],
        'conveyance_date'              => $validatedData['conveyanceDate'],
        'conveyance_exp_date'          => $validatedData['conveyanceExpDate'],
        'filcom_fab_date'              => $validatedData['filcomFabDate'],
        'filcon_exp_date'              => $validatedData['filconExpDate'],
        'ltfrb_reg_date'               => $validatedData['LTFRBRegDate'],
        'ltfrb_exp_date'               => $validatedData['LTFRBExpDate'],
        'engine_number'                => $validatedData['engineNumber'],
        'pms_reg_date'                 => $validatedData['PMSRegDate'],
        'pms_last_mileage'             => $validatedData['PMSLastMileAge'],
        'pms_current_reading'          => $validatedData['PMSCurrentReading'],
        'consume_mileage'              => $validatedData['consumeMileage'],
        'next_pms_mileage'             => $validatedData['nextPMSMileage'],
        'imei'                         => $request->imei,

    ]);

    // Redirect to the vehicle route
    return redirect()->route('vehicle')->with('success', 'Vehicle created successfully!');

    }


    public function upload(Request $request)
    {


        $request->validate([
            'files.*' => 'required|file|mimes:jpeg,png,jpg,gif|max:1024', // Max 1MB per file
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $maintenance = Maintenance_task::where('vehicle_id', $id)->get();

        $notification = Notification::where('vehicle_id', $id)->where('status', 'pending')->count();

        $fuel = Fuel_record::where('vehicle_id', $id)->get();

        return Inertia::render('Vehicle/Show', [
            "Vehicle" => $vehicle,
            "Maintenance" => $maintenance,
            "fuel" => $fuel,
            "notification" => $notification,]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {

        $validatedData = $request->validate([
            'license_plate'         => 'required|string|max:10|unique:vehicles,license_plate,' . $vehicle->id,
            'model'                 => 'required|string|max:255',
            'capacity'              => 'required|integer',
            'status'                => 'required|string|max:50',
            'lto_reg_date'          => 'nullable|date',
            'lto_exp_date'          => 'nullable|date',
            'conveyance_date'       => 'nullable|date',
            'conveyance_exp_date'   => 'nullable|date',
            'filcom_fab_date'       => 'nullable|date',
            'filcon_exp_date'       => 'nullable|date',
            'ltfrb_reg_date'        => 'nullable|date',
            'ltfrb_exp_date'        => 'nullable|date',
            'engine_number'         => 'required|string|max:20|unique:vehicles,engine_number,' . $vehicle->id,
            'pms_reg_date'          => 'required|date',
            'pms_last_mileage'      => 'required|string|max:255',
            'pms_current_reading'   => 'required|string|max:255',
            'consume_mileage'       => 'required|integer',
            'next_pms_mileage'      => 'required|integer',
        ]);

        $vehicle->update($validatedData);

        return redirect()->route('vehicle.show', $vehicle);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicle');
    }

    public function deletedAll(Request $request)
    {
        $ids = $request->ids;
        Vehicle::whereIn('id', $ids)->delete();

        return redirect()->route('vehicle');
    }

    public function getToken(Request $request)
    {

        $appKey = "8FB345B8693CCD0087407F68D5CEC35D339A22A4105B6558";
        $appSecret = "c8c3a6075b5346dc8a6c14480b646eb5";
        $user_id = "Admin_Ruffa";
        $user_pwd_md5 = "d21a49b639720eb00db9026d046acbdd";

        $params = [
            'method' => "jimi.oauth.token.get",
            'app_key' => $appKey,
            'user_id' => $user_id,
            'user_pwd_md5' => $user_pwd_md5,
            'expires_in' => "7200",
            'timestamp' => now('UTC')->format('Y-m-d H:i:s'),
            'format' => "json",
            'v' => "1.0",
            'sign_method' => "md5",
        ];

        ksort($params);
        $signStr = $appSecret;
        foreach ($params as $key => $val) {
            $signStr .= $key . $val;
        }
        $signStr .= $appSecret;
        $params['sign'] = md5($signStr);

        $url = "https://hk-open.tracksolidpro.com/route/rest";
        $response = Http::get($url, $params);

        $data = $response->json();
        \Log::info('Token response data:', $data);

        return response()->json([
            'accessToken' => $data['result']['accessToken'] ?? null,

        ]);
    }

    public function getLocation(Request $request)
        {

            $accessToken = $request->input('accessToken');
            $imei = $request->imei;

            $params = [
                'method' => 'jimi.device.location.get',
                'access_token' => $accessToken,
                'imeis' => $imei,
                'map_type' => 'GOOGLE',
                'timestamp' => now('UTC')->format('Y-m-d H:i:s'),
                'format' => 'json',
                'v' => '1.0',
                'sign_method' => 'md5',
            ];

            // Add your app credentials
            $appKey = '8FB345B8693CCD0087407F68D5CEC35D339A22A4105B6558';
            $appSecret = 'c8c3a6075b5346dc8a6c14480b646eb5';
            $params['app_key'] = $appKey;

            // Sort and sign
            ksort($params);
            $signStr = $appSecret;
            foreach ($params as $key => $val) {
                $signStr .= $key . $val;
            }
            $signStr .= $appSecret;
            $params['sign'] = md5($signStr);

            // Send the POST request
            $url = "https://hk-open.tracksolidpro.com/route/rest";
            $response = Http::asForm()->post($url, $params);

            // Log the full response for debugging
            \Log::info("API Response", ['response' => $response->json()]);

            if ($response->successful()) {
                return response()->json([
                    'location' => $response->json()['result'] ?? [],
                ]);
            } else {
                return response()->json([
                    'error' => 'Failed to retrieve device location'
                ], 500);
            }
        }

}

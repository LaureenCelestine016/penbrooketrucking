<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;

class TracksolidController extends Controller
{
    public function index()
    {
        return Inertia::render('Tracksolid/Index', [
            'tracksolid' => session('tracksolid')
        ]);
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

    // Sort for signature
    ksort($params);
    $signStr = $appSecret;
    foreach ($params as $key => $val) {
        $signStr .= $key . $val;
    }
    $signStr .= $appSecret;
    $params['sign'] = md5($signStr);

    $url = "https://hk-open.tracksolidpro.com/route/rest";
    $response = Http::get($url, $params);

    return back()->with([
        'tracksolid' => [
            'timestamp' => $params['timestamp'],
            'sign' => $params['sign'],
            'response' => $response->json()
        ]
    ]);
    }

    public function getLocation(Request $request)
{
    $accessToken = $request->input('accessToken');
    $deviceId = $request->input('deviceId');
    $target = "your_target_value"; // Replace with actual target value

    if (!$accessToken || !$deviceId || !$target) {
        return inertia('Tracksolid/Index', [
            'error' => 'Missing access token, device ID, or target'
        ]);
    }

    $appKey = "8FB345B8693CCD0087407F68D5CEC35D339A22A4105B6558";
    $appSecret = "c8c3a6075b5346dc8a6c14480b646eb5";
    $timestamp = now('UTC')->format('Y-m-d H:i:s');

    $params = [
        'method' => "jimi.device.location.get", // Changed method for location
        'app_key' => $appKey,
        'access_token' => $accessToken,
        'device_id' => $deviceId,
        'target' => $target,  // Add the target parameter
        'timestamp' => $timestamp,
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

    // Make the API request
    $response = Http::get($url, $params);

    // Log the full response for debugging
    \Log::info("API Response", ['response' => $response->json()]);

    if ($response->successful()) {
        return inertia('Tracksolid/Index', [
            'location' => $response->json()
        ]);
    } else {
        // Log the error response body
        \Log::error("API Error: " . $response->body());
        return inertia('Tracksolid/Index', [
            'error' => 'Failed to retrieve device location'
        ]);
    }
}




}


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
            $imei = '868982050148139';

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


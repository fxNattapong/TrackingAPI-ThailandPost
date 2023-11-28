<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ThailandPostController extends Controller
{
    public function showTrackingForm() {
        return view('track-shipment');
    }

    public function getToken() {
        $client = new Client();

        $token = 'QaOGKIRhSyFRCkAQGAHMDhO2P#S.VTMAQiMWZ!F3EMT;Q3E9SjK&X$FpCWFWNfR_S7FRBlTHX0RBCsWZY.VDRZT#N5EPX@ZdBUYY';

        $response = $client->post("https://trackapi.thailandpost.co.th/post/api/v1/authenticate/token", [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "Token {$token}",
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        $auth_token = $data['token'] ?? null;

        return $auth_token;
    }

    public function trackShipment(Request $request) {
        $auth_token = $this->getToken();

        if (!$auth_token) {
            return response()->json(['error' => 'Unable to obtain token.']);
        }
        // EF582568151TH
        $trackingNumber = $request->input('tracking_number');

        $client = new Client();
        $response = $client->post("https://trackapi.thailandpost.co.th/post/api/v1/track", [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "Token {$auth_token}",
            ],
            'json' => [
                'status' => 'all',
                'language' => 'TH',
                'barcode' => [$trackingNumber],
            ],
        ]);
        $data = json_decode($response->getBody(), true);

        return view('track-result', ['data' => $data]);
    }
}

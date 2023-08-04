<?php

namespace App\Http\Controllers;

use App\Events\StartSubs;
use App\Http\Requests\RegisterRequest;
use App\Models\Device;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DeviceController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $device = Device::where('uid', $request->uid)->first();
        if (empty($device)) {
            $client_token = $this->generateToken();
            $request['client_token'] = $client_token;
            Device::create($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Register OK',
                'client-token' => $client_token
            ], 200);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Register OK',
            'client-token' => $device->client_token,
        ], 200);
    }

    private function generateToken()
    {
        return bin2hex(random_bytes(32));
    }
}

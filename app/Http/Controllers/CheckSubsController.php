<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckSubsRequest;
use App\Models\Device;
use App\Models\Purchase;
use Illuminate\Http\Request;

class CheckSubsController extends Controller
{
    public function checkSubs(CheckSubsRequest $request)
    {

        $client_token = $request->client_token;
        $deviceClientToken = Device::where('client_token', $client_token)->first();
        $purchaseClientToken = Purchase::where('client_token', $client_token)->first();

        if (empty($deviceClientToken) && empty($purchaseClientToken)) {
            return response()->json([
                'status' => 'false',
                'data' => 'No Subscription'
            ]);
        }

        return response()->json([
            'status' => 'active',
            'device' => $deviceClientToken,
            'purchase' => $purchaseClientToken
        ]);

    }
}

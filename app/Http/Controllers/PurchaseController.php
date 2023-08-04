<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    public function purchase(PurchaseRequest $request)
    {

        // Gelen receipt string değerinin son karakterini alın
        $receiptLastNumber = substr($request->receipt, -1);

        $status = false;
        $expireDate = null;

        if (is_numeric($receiptLastNumber) && $receiptLastNumber % 2 === 1) {
            $status = true;
            $utc6 = 'America/Costa_Rica';
            $expireDate = Carbon::now()->setTimezone($utc6)->format('Y:m:d H:i:s');
        }

        Purchase::create([
            'client_token' => $request->client_token,
            'receipt' => $request->receipt,
            'status' => $status,
            'expire_date' => $expireDate,
        ]);

        return response()->json([
            'status' => $status,
            'expire-date' => $expireDate
        ]);

    }
}

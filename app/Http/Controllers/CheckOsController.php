<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckOsRequest;
use App\Models\Purchase;
use Illuminate\Http\Request;

class CheckOsController extends Controller
{
    public function checkOs(CheckOsRequest $request)
    {

        $receipt = $request->receipt;

        $existReceipt = Purchase::where('receipt', $receipt)->first();

        if (empty($existReceipt)) {
            return false;
        }

        return true;

    }
}

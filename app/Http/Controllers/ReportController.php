<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function getReport()
    {
        $start_subs = Transaction::where('expire_date','<',now())->get();
        $renewed_subs = Transaction::where('expire_date','>',now())->where('processed',true)->get();
        $canceled_subs = Transaction::where('expire_date','>',now())->where('processed',false)->get();

        return response()->json([
            'Start Subs' => $start_subs,
            'Renewed Subs' => $renewed_subs,
            'Canceled Subs' => $canceled_subs
        ]);
    }
}

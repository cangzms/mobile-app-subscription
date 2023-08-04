<?php

namespace App\Http\Controllers;

use App\Http\Requests\CallbackRequest;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    public function callback(CallbackRequest $request)
    {
        if ($request) {
            return $request->all();
        }
    }
}

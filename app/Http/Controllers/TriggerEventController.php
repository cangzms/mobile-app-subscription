<?php

namespace App\Http\Controllers;

use App\Events\CancelSubs;
use App\Events\RenewedSubs;
use App\Events\StartSubs;
use App\Http\Requests\TriggerEventRequest;
use Illuminate\Http\Request;

class TriggerEventController extends Controller
{
    public function trigger(TriggerEventRequest $request)
    {

        $event = $request->event;
        $appID = $request->appId;
        $deviceID = $request->deviceId;

        if ($event == 'start') {
            event(new StartSubs($appID, $deviceID));

        }
        if ($event == 'cancel') {
            event(new CancelSubs($appID, $deviceID));

        }
        if ($event == 'renew') {
            event(new RenewedSubs($appID, $deviceID));
        }
    }
}

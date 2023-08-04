<?php

namespace App\Listeners;

use App\Events\CancelSubs;
use GuzzleHttp\Psr7\Request;
use http\Client\Response;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;
use function Composer\Autoload\includeFile;

class PostToThirdParty implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public function broadcastOn()
    {
        return new Channel('started-events');
    }

    /**
     * Handle the event.
     */
    public function handle($event)
    {
        $appID = $event->appId;
        $deviceID = $event->deviceId;
        $eventName = class_basename($event);

        if ($eventName == 'StartSubs') {

            $response = Http::post('http://172.27.0.5/api/callback', [
                'appId' => $appID,
                'deviceId' => $deviceID,
                'event' => $eventName
            ]);

        } elseif ($eventName == 'CancelSubs') {

            $response = Http::post('http://172.27.0.5/api/callback', [
                'appId' => $appID,
                'deviceId' => $deviceID,
                'event' => $eventName
            ]);
        } elseif ($eventName == 'RenewedSubs') {

            $response = Http::post('http://172.27.0.5/api/callback', [
                'appId' => $appID,
                'deviceId' => $deviceID,
                'event' => $eventName
            ]);
        }

        if ($response->successful()) {
            return $response->json();
        } else { // harici bir status alırsa
            $statusCode = $response->status();
            $errorMessage = $response->body();
            return response()->json(['error' => $errorMessage], $statusCode);
        }


    }
}

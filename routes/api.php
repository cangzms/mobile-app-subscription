<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CheckSubsController;
use App\Http\Controllers\CheckOsController;
use App\Http\Controllers\TriggerEventController;
use App\Http\Controllers\CallbackController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//API
Route::post('/register', [DeviceController::class, 'register']);
Route::post('/purchase', [PurchaseController::class, 'purchase']);
Route::post('/check', [CheckSubsController::class, 'checkSubs']);

//WORKER
Route::post('/checkOs', [CheckOsController::class, 'checkOs']);

//CALLBACK
Route::post('triggerEvent', [TriggerEventController::class, 'trigger'])->name('event.trigger');
Route::post('callback', [CallbackController::class, 'callback'])->name('event.callback');



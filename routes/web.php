<?php

use App\Http\Controllers\AdLogController;
use App\Http\Controllers\SdkLogController;
use App\Http\Controllers\SysController;
use App\Http\Middleware\ApiAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'hello';
});
Route::middleware(['web', ApiAuth::class])->prefix('/api')->group(function () {
    Route::post('/sys/status', [SysController::class,'info'])->name('sys.status');
    Route::post('/ad/log', [AdLogController::class,'store'])->name('ad.log');
    Route::post('/sdk/log', [SdkLogController::class,'store'])->name('sdk.log');
});
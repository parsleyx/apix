<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdLogRequest;
use App\Models\AdLog;
use App\Models\Channel;

class AdLogController extends Controller
{
    public function store(AdLogRequest $request)
    {
        $status = $request->input('status');
        $adId = $request->input('adId');
        $log = new AdLog();
        $log->status = $status;
        $channelCode = $request->header('channel-name');
        $channel = Channel::where('code', $channelCode)->first();
        if (!$channel) {
            return response()->json(['message' => 'Channel not found'], 404);
        }
        $log->channel_id = $channel->id;
        $log->model = $request->header('model');
        $log->os_version = $request->header('os-version');
        $log->package_name = $request->header('package-name');
        $log->uuid = $request->header('uuid');
        $log->ad_id = $adId;
        $log->save();
        return response()->json(['message' => 'AdLog created successfully']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\SdkLogRequest;
use App\Models\Channel;
use App\Models\SdkLog;
use Illuminate\Http\Request;

class SdkLogController extends Controller
{
    public function store(SdkLogRequest $request)
    {
        $status = $request->input('status');
        $log = new SdkLog();
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
        $log->save();
        return response()->json(['code' => 200,'message'=> 'success']);
    }
}

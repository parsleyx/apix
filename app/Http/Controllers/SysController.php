<?php

namespace App\Http\Controllers;

use App\Models\AndroidModelWhitelist;
use App\Models\Channel;
use App\Models\CheckLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SysController extends Controller
{
    public function info(Request $request)
    {
        $adId = $request->input('adId');
        $permissionsStr = $request->input('permissions');
        $permissions = explode(',', $permissionsStr);
        $packageName = $request->header('package-name');
        $channelCode = $request->header('channel-code');
        $model = $request->header('model');
        $osVersion = $request->header('os-version');
        $uuid = $request->header('uuid');
        $adId = $request->input('adId');
        $channel = Channel::where('code', $channelCode)->first();
        $androidModelWhitelist = AndroidModelWhitelist::where('model',$model)->where('status','enabled')->first();
        if (!$channel) {
            Log::error('channel not found:' . $channelCode . '');
            return response()->json([
                'code' => 400,
                'message' => 'channel not found'
            ]);
        }
        $channelPower = $channel->power ?? 'off';
        Log::info($packageName);
        // 查询最近12小时内的记录数量
        $checkLog = CheckLog::query()
            ->where('uuid', $uuid)
            ->where('package_name', $packageName)
            ->where('channel_id', $channel->id)
            ->where('ad_id', $adId)
            ->where('created_at', '>=', now()->subHours(12))
            ->count();
        $adPower = $checkLog > 0 ? 'off' : 'on';
        // $package = Package::query()->where('name', $packageName)->where('status','enabled')->first();
        $log = new CheckLog();
        $log->channel_id = $channel->id;
        $log->package_name = $packageName;
        $log->ad_id = $adId;
        $log->uuid = $uuid;
        $log->channel_status = $channelPower;
        $log->ad_status = $adPower;
        $log->model_status = empty($androidModelWhitelist)? 'off' : 'on';
        $log->model = $model;
        $log->permissions = $permissionsStr;
        $log->permission_status = 'on';
        $log->os_version = $osVersion;
        $log->save();
        $power = $channelPower == 'off' || $adPower == 'off' || $log->model_status == 'off' ? 'off' : 'on';
        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => [
                'power' => $power
            ]
        ]);
    }
}

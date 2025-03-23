<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckLog extends Model
{
    protected $fillable = [
        'model',
        'os_version',
        "uuid",
        "channel_id",
        "package_name",
        "channel_status",
        "ad_id",
        "ad_status",
        "model_status",
    ];
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}

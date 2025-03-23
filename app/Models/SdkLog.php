<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SdkLog extends Model
{
    

    protected $fillable = [
        'model',
        'os_version',
        "uuid",
        "channel_id",
        "package_name",
        "status",
    ];
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}

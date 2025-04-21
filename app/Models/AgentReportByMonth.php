<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentReportByMonth extends Model
{
    protected $fillable = [
        "channel_id",
        "package_id",
        "started_at",
        "ended_at",
        "show",
        "money"
    ];
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}

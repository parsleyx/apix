<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AndroidModelWhitelist extends Model
{
    protected $fillable = [
        'name',
        'model',
        "status",
    ];
}

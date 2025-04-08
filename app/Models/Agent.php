<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends User {
    
    protected $table = "users";
    protected $fillable = [
        "name",
        "email",
        "password",
        "role"
    ];
    protected static function booted()
    {
        static::addGlobalScope('role', function ($builder) {
            $builder->where('role', 'agent');
        });

    }
    
}

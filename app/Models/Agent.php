<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    
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
    
    public function packages(){
        return $this->belongsToMany(Package::class, 'user_package', 'user_id', 'package_id');
    }
}

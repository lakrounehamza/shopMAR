<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livreur extends User
{
 
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [ 
        'telephone',
        'vehicle_type',  
        'vehicle_plate',  
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}

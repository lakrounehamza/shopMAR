<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livreur extends User
{
 
    protected $fillable = [
    'id_user',
    'zoneTravail',
    'disponible',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function livraisons()
    {
        return $this->hasMany(Livraison::class);
    }
}

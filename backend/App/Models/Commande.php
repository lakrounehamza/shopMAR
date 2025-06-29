<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'payment_method',
        'total_prix',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}

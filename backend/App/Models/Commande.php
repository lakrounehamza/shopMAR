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
    
    public function commandeItems()
    {
        return $this->hasMany(CommandeItem::class);
    }
        public function livraison()
    {
        return $this->hasOne(Livraison::class);
    }
}

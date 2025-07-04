<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommandeItem extends Model
{
    protected $fillable = [
        'commande_id',
        'type_produit_id',
        'quantity',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function typeProduit()
    {
        return $this->belongsTo(TypeProduit::class, 'type_produit_id');
    }
}

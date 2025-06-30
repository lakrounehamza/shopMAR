<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paiement extends Model
{ 

    protected $fillable = [
        'id_commande',
        'montant',
        'mode_paiement',
        'status',
        'transaction_id',
    ];

    public function commande(): BelongsTo
    {
        return $this->belongsTo(Commande::class,);
    }
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class,);
    }
    public function livreur(): BelongsTo
    {
        return $this->belongsTo(Livreur::class,);
    }
}

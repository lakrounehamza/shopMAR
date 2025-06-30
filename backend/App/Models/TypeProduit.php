<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeProduit extends Model
{
    protected $fillable = [
        'type',
        'prix',
        'image',
        'quantiteStock',
    ];

    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends User
{
     protected $fillable = [
        'id_user',
        'adresseVille' ,
        'adresseRue',
        'adresseCodePostal',
        'adressePays',
     ];
      public function user()
      {
          return $this->belongsTo(User::class, );
      }
      public function livraisons()
      {
          return $this->hasMany(Livraison::class, );      

      }
      public function paiements()
      {
          return $this->hasMany(Paiement::class);
      }
      public function commandes()
      {
          return $this->hasMany(Commande::class);
      } 
}

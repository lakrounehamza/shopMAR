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
}

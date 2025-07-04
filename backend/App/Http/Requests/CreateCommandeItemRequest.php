<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommandeItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'commande_id'      => 'required|integer|exists:commandes,id',
            'type_produit_id'  => 'required|integer|exists:type_produits,id',
            'quantity'         => 'required|integer|min:1',
        ];
    }
}

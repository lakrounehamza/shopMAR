<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Paiement;

class CreatePaiementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_commande' => 'required|integer|exists:commandes,id',
            'montant' => 'required|numeric|min:0.01|max:999999.99',
            'mode_paiement' => 'required|in:paypal,cash_on_delivery',
            'status' => 'nullable|in:en_attente,effectue,annule,rembourse',
            'notes' => 'nullable|string|max:1000',
        ];
    }
 
 
}

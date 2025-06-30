<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\CreatePaiementRequest;
use App\Http\Requests\UpdatePaiementRequest;
use Illuminate\Http\JsonResponse;

interface PaiementRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function create(CreatePaiementRequest $request);
    public function update($id, UpdatePaiementRequest $request);
    public function delete($id);
    public function getByCommandeId($id_commande);
    public function getByStatus($status);
    public function getByModePaiement($mode_paiement);
    public function getByTransactionId($transaction_id); 
}

<?php

namespace App\Repositories\Interfaces;
use App\Http\Requests\CreateCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
interface CommandeRepositoryInterface
{
    public function getAllCommandes();
    public function getCommandeById($id);
    public function createCommande(CreateCommandeRequest $data);
    public function updateCommande($id, UpdateCommandeRequest $data);
    public function deleteCommande($id);
    public function getCommandesByClientId($clientId);
    public function getCommandesByLivreurId($livreurId);
    public function getCommandesByStatus($status);
    public function searchCommandes(string $query);
}

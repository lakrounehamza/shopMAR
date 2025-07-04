<?php

namespace App\Repositories\Interfaces;
use App\Http\Requests\CreateCommandeItemRequest;
use App\Http\Requests\UpdateCommandeItemRequest;
interface CommandeItemRepositoryInterface
{

    public function getAll();
    public function getById(int $id);   
    public function create(CreateCommandeItemRequest $data);
    public function update(int $id, UpdateCommandeItemRequest $data);
    public function delete(int $id);
    public function getByCommandeId(int $commandeId);
    public function getByProduitId(int $produitId);
    public function getByTypeProduitId(int $typeProduitId);
    public function getByCategoryId(int $categoryId);
    public function getByCategoryName(string $categoryName);
}

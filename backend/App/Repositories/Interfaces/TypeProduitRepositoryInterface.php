<?php

namespace App\Repositories\Interfaces;
use App\Http\Requests\CreateTypeProduitRequest;
use App\Http\Requests\UpdateTypeProduitRequest;
interface TypeProduitRepositoryInterface
{
    public function getAllTypeProduits();
    public function getTypeProduitById($id);
    public function createTypeProduit(CreateTypeProduitRequest $data);
    public function updateTypeProduit($id, UpdateTypeProduitRequest $data);
    public function deleteTypeProduit($id);
    public function getTypeProduitsByProduitId($produitId);
    public function getTypeProduitsByProduitName($produitName);
    public function getTypeProduitsWithProduits();
    public function getTypeProduitsByProduitCategoryId($categoryId);
    public function getTypeProduitsByProduitCategoryName($categoryName);
}

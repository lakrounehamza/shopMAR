<?php

namespace App\Repositories\Interfaces;
use App\Http\Requests\CreatePoduitRequest;
use App\Http\Requests\UpdatePoduitRequest;
interface ProduitRepositoryInterface
{
    public function getAllProduits();
    public function getProduitById($id);
    public function createProduit(CreatePoduitRequest $data);
    public function updateProduit($id, UpdatePoduitRequest $data);
    public function deleteProduit($id);
    public function getProduitByName($name);
    public function getProduitsWithCategories();
    public function getProduitsByCategoryId($categoryId);
    public function getProduitsByCategoryName($categoryName);
}
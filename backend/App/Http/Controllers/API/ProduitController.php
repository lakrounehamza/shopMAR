<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePoduitRequest;
use App\Http\Requests\UpdatePoduitRequest;
use App\Repositories\ProduitRepository ;

class ProduitController extends Controller
{
    private ProduitRepository $produitRepository;
    
    public function __construct(ProduitRepository $produitRepository)
    {
        $this->produitRepository = $produitRepository;
    }
    public function index()
    {
        return $this->produitRepository->getAllProduits();
    }

    public function show($id)
    {
        return $this->produitRepository->getProduitById($id);
    }

    public function store(CreatePoduitRequest $request)
    {
        return $this->produitRepository->createProduit($request);
    }

    public function update(UpdatePoduitRequest $request, $id)
    {
        return $this->produitRepository->updateProduit($id, $request);
    }

    public function destroy($id)
    {
        return $this->produitRepository->deleteProduit($id);
    }

    public function findByName($name)
    {
        return $this->produitRepository->getProduitByName($name);
    }

    public function produitsWithCategories()
    {
        return $this->produitRepository->getProduitsWithCategories();
    }

    public function produitsByCategoryId($categoryId)
    {
        return $this->produitRepository->getProduitsByCategoryId($categoryId);
    }

    public function produitsByCategoryName($categoryName)
    {
        return $this->produitRepository->getProduitsByCategoryName($categoryName);
    }
}

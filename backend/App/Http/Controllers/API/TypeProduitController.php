<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTypeProduitRequest;
use App\Http\Requests\UpdateTypeProduitRequest;
use App\Repositories\TypeProduitRepository; 

class TypeProduitController extends Controller
{
    private TypeProduitRepository $typeProduitRepository;
    
    public function __construct(TypeProduitRepository $typeProduitRepository)
    {
        $this->typeProduitRepository = $typeProduitRepository;
    }
    public function index()
    {
        return $this->typeProduitRepository->getAllTypeProduits();
    }

    public function show($id)
    {
        return $this->typeProduitRepository->getTypeProduitById($id);
    }

    public function store(CreateTypeProduitRequest $request)
    {
        return $this->typeProduitRepository->createTypeProduit($request);
    }

    public function update(UpdateTypeProduitRequest $request, $id)
    {
        return $this->typeProduitRepository->updateTypeProduit($id, $request);
    }

    public function destroy($id)
    {
        return $this->typeProduitRepository->deleteTypeProduit($id);
    }

    public function findByName($name)
    {
        return $this->typeProduitRepository->getTypeProduitsByProduitName($name);
    }

    public function typeProduitsWithProduits()
    {
        return $this->typeProduitRepository->getTypeProduitsWithProduits();
    }

    public function typeProduitsByProduitId($produitId)
    {
        return $this->typeProduitRepository->getTypeProduitsByProduitId($produitId);
    }

    public function typeProduitsByProduitCategoryId($categoryId)
    {
        return $this->typeProduitRepository->getTypeProduitsByProduitCategoryId($categoryId);
    }

    public function typeProduitsByProduitCategoryName($categoryName)
    {
        return $this->typeProduitRepository->getTypeProduitsByProduitCategoryName($categoryName);
    }
}

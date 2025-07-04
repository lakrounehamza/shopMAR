<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CommandeItemRepositoryInterface;
use App\Http\Requests\CreateCommandeItemRequest;
use App\Http\Requests\UpdateCommandeItemRequest;

class CommandeItemController extends Controller
{
    protected $repository;

    public function __construct(CommandeItemRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->getAll();
    }

    public function store(CreateCommandeItemRequest $request)
    {
        return $this->repository->create($request);
    }

    public function show($id)
    {
        return $this->repository->getById($id);
    }

    public function update(UpdateCommandeItemRequest $request, $id)
    {
        return $this->repository->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->repository->delete($id);
    }

    public function getByCommandeId($commandeId)
    {
        return $this->repository->getByCommandeId($commandeId);
    }

    public function getByProduitId($produitId)
    {
        return $this->repository->getByProduitId($produitId);
    }

    public function getByTypeProduitId($typeProduitId)
    {
        return $this->repository->getByTypeProduitId($typeProduitId);
    }

    public function getByCategoryId($categoryId)
    {
        return $this->repository->getByCategoryId($categoryId);
    }

    public function getByCategoryName($categoryName)
    {
        return $this->repository->getByCategoryName($categoryName);
    }
    
}
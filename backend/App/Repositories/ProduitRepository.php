<?php

namespace App\Repositories;
use App\Repositories\Interfaces\ProduitRepositoryInterface;
use App\Http\Requests\CreatePoduitRequest;
use App\Http\Requests\UpdatePoduitRequest;
use App\Models\Produit;
class ProduitRepository implements ProduitRepositoryInterface
{
    public function getAllProduits()
    {
        $produits = Produit::all();
        if(!$produits) {
            return response()->json([
                'success' => false,
                'message' => 'No produits found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $produits
        ], 200);
    } 
    public function getProduitById($id)
    {
        $produit = Produit::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $produit
        ], 200);
    }

    public function createProduit(CreatePoduitRequest $data)
    {
        $produit = Produit::create([
            'name' => $data->name,
            'description' => $data->description,
            'category_id' => $data->category_id,
        ]);
        return response()->json([
            'success' => true,
            'data' => $produit
        ], 201);
    }

    public function updateProduit($id, UpdatePoduitRequest $data)
    {
        $produit = Produit::findOrFail($id);
        $produit->update([
            'name' => $data->name,
            'description' => $data->description,
            'category_id' => $data->category_id,
        ]);
        return response()->json([
            'success' => true,
            'data' => $produit
        ], 200);
    }

    public function deleteProduit($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();
        return response()->json([
            'success' => true,
            'message' => 'Produit deleted successfully'
        ], 200);
    }

    public function getProduitByName($name)
    {
        $produit = Produit::where('name', $name)->first();
        return response()->json([
            'success' => true,
            'data' => $produit
        ], 200);
    }

    public function getProduitsWithCategories()
    {
        $produits = Produit::with('category')->get();
        return response()->json([
            'success' => true,
            'data' => $produits
        ], 200);
    }

    public function getProduitsByCategoryId($categoryId)
    {
        $produits = Produit::where('category_id', $categoryId)->get();
        return response()->json([
            'success' => true,
            'data' => $produits
        ], 200);
    }

    public function getProduitsByCategoryName($categoryName)
    {
        $produits = Produit::whereHas('category', function ($query) use ($categoryName) {
            $query->where('name', $categoryName);
        })->get();
        return response()->json([
            'success' => true,
            'data' => $produits
        ], 200);
    }
}

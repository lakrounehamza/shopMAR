<?php

namespace App\Repositories;
use App\Repositories\Interfaces\TypeProduitRepositoryInterface;
use App\Http\Requests\CreateTypeProduitRequest;
use App\Http\Requests\UpdateTypeProduitRequest;
use App\Models\TypeProduit;
class TypeProduitRepository implements TypeProduitRepositoryInterface
{
    public function getAllTypeProduits()
    {
        $typeProduits = TypeProduit::all();
        if(!$typeProduits) {
            return response()->json([
                'success' => false,
                'message' => 'No type produits found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $typeProduits
        ], 200);
    }

    public function getTypeProduitById($id)
    {
        $typeProduit = TypeProduit::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $typeProduit
        ], 200);
    }

    public function createTypeProduit(CreateTypeProduitRequest $data)
    {
        $typeProduit = TypeProduit::create([
            'type' => $data->type,
            'prix' => $data->prix,
            'image' => $data->image,
            'quantiteStock' => $data->quantiteStock,
        ]);
        return response()->json([
            'success' => true,
            'data' => $typeProduit
        ], 201);
    }

    public function updateTypeProduit($id, UpdateTypeProduitRequest $data)
    {
        $typeProduit = TypeProduit::findOrFail($id);
        $typeProduit->update([
            'type' => $data->type,
            'prix' => $data->prix,
            'image' => $data->image,
            'quantiteStock' => $data->quantiteStock,
        ]);
        return response()->json([
            'success' => true,
            'data' => $typeProduit
        ], 200);
    }

    public function deleteTypeProduit($id)
    {
        $typeProduit = TypeProduit::findOrFail($id);
        $typeProduit->delete();
        return response()->json([
            'success' => true,
            'message' => 'Type produit deleted successfully'
        ], 200);
    }

    public function getTypeProduitsByProduitId($produitId)
    {
        return TypeProduit::where('produit_id', $produitId)->get();
    }

    public function getTypeProduitsByProduitName($produitName)
    {
        return TypeProduit::whereHas('produits', function($query) use ($produitName) {
            $query->where('name', 'like', '%' . $produitName . '%');
        })->get();
    }

    public function getTypeProduitsWithProduits()
    {
        return TypeProduit::with('produits')->get();
    }

    public function getTypeProduitsByProduitCategoryId($categoryId)
    {
        return TypeProduit::whereHas('produits', function($query) use ($categoryId) {
            $query->where('category_id', $categoryId);
        })->get();
    }

    public function getTypeProduitsByProduitCategoryName($categoryName)
    {
        return TypeProduit::whereHas('produits.category', function($query) use ($categoryName) {
            $query->where('name', 'like', '%' . $categoryName . '%');
        })->get();
    }
}

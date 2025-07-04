<?php

namespace App\Repositories;

use App\Repositories\Interfaces\CommandeItemRepositoryInterface;
use App\Http\Requests\CreateCommandeItemRequest;
use App\Http\Requests\UpdateCommandeItemRequest;
use App\Models\CommandeItem;

class CommandeItemRepository implements CommandeItemRepositoryInterface
{
    public function getAll()
    {
        $commandeItem = CommandeItem::with(['commande', 'typeProduit.produit'])->get();
        if (!$commandeItem) {
            return response()->json([
                'status' => 'error',
                'message' => 'No commande items found'
            ], 404);
        }
        return  response()->json([
            'status' => 'success',
            'data' => $commandeItem
        ], 200);
    }

    public function getById(int $id)
    {
        $commandeItem = CommandeItem::with(['commande', 'typeProduit.produit'])->find($id);
        if (!$commandeItem) {
            return response()->json([
                'status' => 'error',
                'message' => 'Commande item not found'
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'data' => $commandeItem
        ], 200);
    }

    public function create(CreateCommandeItemRequest $data)
    {
        $commandeItem = CommandeItem::create([
            'commande_id' => $data->commande_id,
            'type_produit_id' => $data->type_produit_id,
            'quantity' => $data->quantity,
        ]);

        if (!$commandeItem) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create commande item'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'data' => $commandeItem
        ], 201);
    }

    public function update(int $id, UpdateCommandeItemRequest $data)
    {
        $commandeItem = CommandeItem::find($id);
        if (!$commandeItem) {
            return response()->json([
                'status' => 'error',
                'message' => 'Commande item not found'
            ], 404);
        }

        $commandeItem->update([
            'commande_id' => $data->commande_id,
            'type_produit_id' => $data->type_produit_id,
            'quantity' => $data->quantity,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $commandeItem
        ], 200);
    }

    public function delete(int $id)
    {
        $commandeItem = CommandeItem::find($id);
        if (!$commandeItem) {
            return response()->json([
                'status' => 'error',
                'message' => 'Commande item not found'
            ], 404);
        }

        $commandeItem->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Commande item deleted successfully'
        ], 200);
    }

    public function getByCommandeId(int $commandeId)
    {
        $commandeItems = CommandeItem::with(['commande', 'typeProduit.produit'])
            ->where('commande_id', $commandeId)
            ->get();

        if ($commandeItems->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No items found for this commande'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $commandeItems
        ], 200);
    }

    public function getByProduitId(int $produitId)
    {
        $commandeItems = CommandeItem::with(['commande', 'typeProduit.produit'])
            ->whereHas('typeProduit.produit', function ($query) use ($produitId) {
                $query->where('id', $produitId);
            })
            ->get();

        if ($commandeItems->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No items found for this produit'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $commandeItems
        ], 200);
    }

    public function getByTypeProduitId(int $typeProduitId)
    {
        $commandeItems = CommandeItem::with(['commande', 'typeProduit.produit'])
            ->where('type_produit_id', $typeProduitId)
            ->get();

        if ($commandeItems->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No items found for this type produit'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $commandeItems
        ], 200);
    }

    public function getByCategoryId(int $categoryId)
    { 
        $commandeItems = CommandeItem::with(['commande', 'typeProduit.produit.category'])
            ->whereHas('typeProduit.produit.category', function ($query) use ($categoryId) {
                $query->where('id', $categoryId);
            })
            ->get();

        if ($commandeItems->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No items found for this category'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $commandeItems
        ], 200);
    }

    public function getByCategoryName(string $categoryName)
    { 
        $commandeItems = CommandeItem::with(['commande', 'typeProduit.produit.category'])
            ->whereHas('typeProduit.produit.category', function ($query) use ($categoryName) {
                $query->where('name', $categoryName);
            })
            ->get();

        if ($commandeItems->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No items found for this category name'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $commandeItems
        ], 200);
    }
}

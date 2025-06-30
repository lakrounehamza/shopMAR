<?php

namespace App\Repositories;
use App\Repositories\Interfaces\LivraisonRepositoryInterface;
use App\Http\Requests\CreateLivraisonRequest;
use App\Http\Requests\UpdateLivraisonRequest;
use App\Models\Livraison;
class LivraisonRepository implements LivraisonRepositoryInterface
{
    public function createLivraison(CreateLivraisonRequest $request)
    {
        $livraison = Livraison::create([
            'id_client' => $request->id_client,
            'id_livreur' => $request->id_livreur,
            'adresse' => $request->adresse,
            'date_livraison' => $request->date_livraison,
            'status' => $request->status,
        ]);
        return response()->json([
            'success' => true,
            'data' => $livraison
        ], 201);
    }

    public function updateLivraison(UpdateLivraisonRequest $request, int $id)
    {
        $livraison = Livraison::findOrFail($id);
        $livraison->update($request->validated());
        return response()->json([
            'success' => true,
            'data' => $livraison
        ], 200);
    }

    public function deleteLivraison(int $id)
    {
        $livraison = Livraison::findOrFail($id);
        $livraison->delete();
        return response()->json([
            'success' => true,
            'message' => 'Livraison deleted successfully'
        ], 200);
    }

    public function getLivraisonById(int $id)
    {
        $livraison = Livraison::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $livraison
        ], 200);
    }

    public function getAllLivraisons()
    {
        $livraisons = Livraison::all();
        return response()->json([
            'success' => true,
            'data' => $livraisons
        ], 200);
    }

    public function searchLivraisons(string $query)
    {
        $livraisons = Livraison::where('adresse', 'like', "%{$query}%")->get();
        return response()->json([
            'success' => true,
            'data' => $livraisons
        ], 200);        
    }

    public function getLivraisonsByClientId(int $clientId)
    {
        $livraisons = Livraison::where('id_client', $clientId)->get();
        return response()->json([
            'success' => true,
            'data' => $livraisons
        ], 200);
    }

    public function getLivraisonsByLivreurId(int $livreurId)
    {
        $livraisons = Livraison::where('id_livreur', $livreurId)->get();
        return response()->json([
            'success' => true,
            'data' => $livraisons
        ], 200);
    }

    public function getLivraisonsByStatus(string $status)
    {
        $livraisons = Livraison::where('status', $status)->get();
        return response()->json([
            'success' => true,
            'data' => $livraisons
        ], 200);
    }

    public function getLivraisonsByDateRange(string $startDate, string $endDate)
    {
        $livraisons = Livraison::whereBetween('date_livraison', [$startDate, $endDate])->get();
        return response()->json([
            'success' => true,
            'data' => $livraisons
        ], 200);
    }               
}

<?php

namespace App\Repositories;
use App\Repositories\Interfaces\LivreurRepositoryInterface;
use App\Http\Requests\CreateLivreurRequest;
use App\Http\Requests\UpdateLivreurRequest;
use App\Models\Livreur;
class LivreurRepository  implements LivreurRepositoryInterface
{
    public function createLivreur(CreateLivreurRequest $request)
    {
        $livreur = Livreur::create([
            'id_user' => $request->id_user,
            'zoneTravail' => $request->zoneTravail,
        ]);
        return response()->json([
            'success' => true,
            'data' => $livreur
        ], 201);
    }
    public function updateLivreur(UpdateLivreurRequest $request, int $id)
    {
        $livreur = Livreur::findOrFail($id);
        $livreur->update([
            'zoneTravail' => $request->zoneTravail,
            'disponible' => $request->disponible,
        ]);
        return response()->json([
            'success' => true,
            'data' => $livreur
        ], 200);
    }
    
    public function deleteLivreur(int $id)
    {
        $livreur = Livreur::findOrFail($id);
        $livreur->delete();
        return response()->json([
            'success' => true,
            'message' => 'Livreur deleted successfully'
        ], 200);
    }
    
    public function getLivreurById(int $id)
    {
        $livreur = Livreur::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $livreur
        ], 200);
    }
    
    public function getAllLivreurs()
    {
        $livreurs = Livreur::all();
        return response()->json([
            'success' => true,
            'data' => $livreurs
        ], 200);
    }
    
    public function searchLivreurs(string $query)
    {
        $livreurs = Livreur::where('zoneTravail', 'like', "%{$query}%")->get();
        return response()->json([
            'success' => true,
            'data' => $livreurs
        ], 200);
    }
    
    public function getLivreursByUserId(int $userId)
    {
        $livreurs = Livreur::where('id_user', $userId)->get();
        return response()->json([
            'success' => true,
            'data' => $livreurs
        ], 200);
    }
    
    public function getLivreursByZoneTravail(string $zoneTravail)
    {
        $livreurs = Livreur::where('zoneTravail', $zoneTravail)->get();
        return response()->json([
            'success' => true,
            'data' => $livreurs
        ], 200);
    }
    
    public function getLivreursDisponibles()
    {
        $livreurs = Livreur::where('disponible', true)->get();
        return response()->json([
            'success' => true,
            'data' => $livreurs
        ], 200);
    }
    
    public function getLivreursByDisponibilite(bool $disponibilite)
    {
        $livreurs = Livreur::where('disponible', $disponibilite)->get();
        return response()->json([
            'success' => true,
            'data' => $livreurs
        ], 200);
    } 
    
}

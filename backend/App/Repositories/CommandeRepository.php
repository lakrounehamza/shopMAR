<?php

namespace App\Repositories;
use App\Repositories\Interfaces\CommandeRepositoryInterface;
use App\Http\Requests\CreateCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
use App\Models\Commande;
class CommandeRepository  implements CommandeRepositoryInterface
{
 
    public function getAllCommandes()
    {
        $commandes = Commande::all();
        return response()->json([
            'success' => true,
            'data' => $commandes
        ], 200);
        
    }
    public function getCommandeById($id)
    {
        $commande = Commande::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $commande
        ], 200);
    }
    public function createCommande( CreateCommandeRequest  $data){
        $commande = Commande::create([
           
            'user_id' => $data['user_id'],
            'status' => $data['status'],
            'payment_method' => $data['payment_method'],
            'total_prix' => $data['total_prix'],

        ]);
        return response()->json([
            'success' => true,
            'data' => $commande
        ], 201);
    }
    public function updateCommande($id, UpdateCommandeRequest $data)
    {
        $commande = Commande::findOrFail($id);
        $commande->update([
            'id_client' => $data['id_client'],
            'id_livreur' => $data['id_livreur'],
            'status' => $data['status'],
            'total' => $data['total'],
            'date_commande' => $data['date_commande'],
        ]);
        return response()->json([
            'success' => true,
            'data' => $commande
        ], 200);
    }
    public function deleteCommande($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->delete();
        return response()->json([
            'success' => true,      
            'message' => 'Commande deleted successfully'
        ], 200);
    }
    public function getCommandesByClientId($clientId)
    {
        $commandes = Commande::where('id_client', $clientId)->get();
        return response()->json([
            'success' => true,
            'data' => $commandes
        ], 200);
    }
    public function getCommandesByLivreurId($livreurId)
    {
        $commandes = Commande::where('id_livreur', $livreurId)->get();
        return response()->json([
            'success' => true,
            'data' => $commandes
        ], 200);
    }
    public function getCommandesByStatus($status)
    {
        $commandes = Commande::where('status', $status)->get();
        return response()->json([
            'success' => true,
            'data' => $commandes
        ], 200);
    }
    public function searchCommandes(string $query){
        $commandes = Commande::where('id_client', 'LIKE', "%{$query}%")
            ->orWhere('id_livreur', 'LIKE', "%{$query}%")
            ->orWhere('status', 'LIKE', "%{$query}%")
            ->orWhere('total', 'LIKE', "%{$query}%")
            ->orWhere('date_commande', 'LIKE', "%{$query}%")
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $commandes
        ], 200);    
    }
}

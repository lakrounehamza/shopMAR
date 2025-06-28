<?php

namespace App\Repositories;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;

class ClientRepository implements ClientRepositoryInterface
{
    public function createClient(CreateClientRequest $request)
    {
        $client = Client::create([
            'id_user' => $request->id_user,
            'adresseVille' => $request->adresseVille,
            'adresseRue' => $request->adresseRue,
            'adresseCode_postal' => $request->adresseCodePostal,
            'adressePays' => $request->adressePays,
        ]);
        return response()->json([
            'success' => true,
            'data' => $client
        ], 201);    
    }
    public function updateClient(UpdateClientRequest $request, int $id)
    {
        $client = Client::findOrFail($id);
        $client->update([
            'adresseVille' => $request->adresseVille,
            'adresseRue' => $request->adresseRue,
            'adresseCodePostal' => $request->adresseCodePostal,
            'adressePays' => $request->adressePays,
        ]);
        return response()->json([
            'success' => true,
            'data' => $client
        ], 200);
    }
    
    public function deleteClient(int $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return response()->json([
            'success' => true,
            'message' => 'Client deleted successfully'
        ], 200);
    }
    
    public function getClientById(int $id)
    {
        $client = Client::join('users', 'clients.id_user', '=', 'users.id')
                       ->select('clients.*', 'users.name as userName', 'users.email as userEmail', 'users.phone as userPhone')
                       ->where('clients.id', $id)
                       ->firstOrFail();
        return response()->json([
            'success' => true,
            'data' => $client
        ], 200);
    }
    
    public function getAllClients()
    {
        $clients = Client::join('users', 'clients.id_user', '=', 'users.id')
                        ->select('clients.*', 'users.name as userName', 'users.email as userEmail', 'users.phone as userPhone')
                        ->get();
        return response()->json([
            'success' => true,
            'data' => $clients
        ], 200);
    }
    
    public function searchClients(string $query)
    {
        $clients = Client::where('adresseVille', 'like', "%{$query}%")
                         ->orWhere('adresseRue', 'like', "%{$query}%")
                         ->get();
        return response()->json([
            'success' => true,
            'data' => $clients
        ], 200);
    }
    
    public function getClientsByUserId(int $userId)
    {
        $clients = Client::where('id_user', $userId)->get();
        return response()->json([
            'success' => true,
            'data' => $clients
        ], 200);
    }
}

<?php

namespace App\Repositories\Interfaces;
use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;
interface ClientRepositoryInterface
{
    public function createClient(CreateClientRequest $request);
    public function updateClient(UpdateClientRequest $request, int $id);
    public function deleteClient(int $id);
    public function getClientById(int $id);
    public function getAllClients();
    public function searchClients(string $query);
    public function getClientsByUserId(int $userId);
    
}

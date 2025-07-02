<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ClientRepository;
use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;
class ClientController extends Controller
{
    protected $clientRepository;
    
    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }   
    public  function  store(CreateClientRequest $request)
    {
        return $this->clientRepository->createClient($request);
    }

    public function update(UpdateClientRequest $request, int $id)
    {
        return $this->clientRepository->updateClient($request, $id);
    }

    public function destroy(int $id)
    {
        return $this->clientRepository->deleteClient($id);
    }

    public function show(int $id)
    {
        return $this->clientRepository->getClientById($id);
    }

    public function index()
    {
        return $this->clientRepository->getAllClients();
    }

    public function search(Request $request)
    {
        return $this->clientRepository->searchClients($request->query('q'));
    }

    public function getClientsByUserId(int $userId)
    {
        return $this->clientRepository->getClientsByUserId($userId);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\LivreurRepository;
use App\Http\Requests\CreateLivreurRequest;
use App\Http\Requests\UpdateLivreurRequest;
class LivreurController extends Controller
{
    protected $livreurRepository;
    
    public function __construct(LivreurRepository $livreurRepository)
    {
        $this->livreurRepository = $livreurRepository;
    }   
    public function store(CreateLivreurRequest $request)
    {
        return $this->livreurRepository->createLivreur($request);
    }

    public function update(UpdateLivreurRequest $request, int $id)
    {
        return $this->livreurRepository->updateLivreur($request, $id);
    }

    public function destroy(int $id)
    {
        return $this->livreurRepository->deleteLivreur($id);
    }

    public function show(int $id)
    {
        return $this->livreurRepository->getLivreurById($id);
    }

    public function index()
    {
        return $this->livreurRepository->getAllLivreurs();
    }

    public function search(Request $request)
    {
        return $this->livreurRepository->searchLivreurs($request->query('q'));
    }

    public function getLivreursByUserId(int $userId)
    {
        return $this->livreurRepository->getLivreursByUserId($userId);      
}
    public function getLivreursByZoneTravail(string $zoneTravail)
    {
        return $this->livreurRepository->getLivreursByZoneTravail($zoneTravail);
    }

    public function getLivreursDisponibles()
    {
        return $this->livreurRepository->getLivreursDisponibles();
    }

    public function getLivreursByDisponibilite(bool $disponibilite)
    {
        return $this->livreurRepository->getLivreursByDisponibilite($disponibilite);
    }
}               

<?php

namespace App\Repositories\Interfaces;
use App\Http\Requests\CreateLivreurRequest;
use App\Http\Requests\UpdateLivreurRequest;
interface LivreurRepositoryInterface
{
    public function createLivreur(CreateLivreurRequest $request);
    public function updateLivreur(UpdateLivreurRequest $request, int $id);
    public function deleteLivreur(int $id);
    public function getLivreurById(int $id);
    public function getAllLivreurs();
    public function searchLivreurs(string $query);
    public function getLivreursByUserId(int $userId);
    public function getLivreursByZoneTravail(string $zoneTravail);
    public function getLivreursDisponibles();
    public function getLivreursByDisponibilite(bool $disponibilite);
}

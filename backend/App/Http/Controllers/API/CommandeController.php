<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
use App\Repositories\CommandeRepository;

class CommandeController extends Controller
{
    protected $commandeRepository;
    public function __construct(CommandeRepository $commandeRepository)
    {
        $this->commandeRepository = $commandeRepository;
    }
    public function index()
    {
        return $this->commandeRepository->getAllCommandes();
    }
    public function show($id)
    {
        return $this->commandeRepository->getCommandeById($id);
    }
    public function store(CreateCommandeRequest $request)
    {
        return $this->commandeRepository->createCommande($request);
    }
    public function update(UpdateCommandeRequest $request, $id)
    {
        return $this->commandeRepository->updateCommande($id, $request);
    }
    public function destroy($id)
    {
        return $this->commandeRepository->deleteCommande($id);
    }
    public function getCommandesByClientId($clientId)
    {
        return $this->commandeRepository->getCommandesByClientId($clientId);
    }
    public function getCommandesByLivreurId($livreurId)
    {
        return $this->commandeRepository->getCommandesByLivreurId($livreurId);
    }
    public function getCommandesByStatus($status)
    {
        return $this->commandeRepository->getCommandesByStatus($status);
    }
    public function searchCommandes(Request $request)
    {
        $query = $request->input('query');
        return $this->commandeRepository->searchCommandes($query);
    }
    // public function getCommandesByDate(Request $request)
    // {
    //     $date = $request->input('date');
    //     return $this->commandeRepository->getCommandesByDate($date);
    // }
    // public function getCommandesByDateRange(Request $request)
    // {
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');
    //     return $this->commandeRepository->getCommandesByDateRange($startDate, $endDate);
    // }
    // public function getCommandesByTotalRange(Request $request)
    // {
    //     $minTotal = $request->input('min_total');
    //     $maxTotal = $request->input('max_total');
    //     return $this->commandeRepository->getCommandesByTotalRange($minTotal, $maxTotal);
    // }
    // public function getCommandesByLivreurAndStatus(Request $request)
    // {
    //     $livreurId = $request->input('livreur_id');
    //     $status = $request->input('status');
    //     return $this->commandeRepository->getCommandesByLivreurAndStatus($livreurId, $status);
    // }
}

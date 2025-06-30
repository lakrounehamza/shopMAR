<?php

namespace App\Repositories\Interfaces;
use App\Http\Requests\CreateRatingRequest;          
use App\Http\Requests\UpdateRatingRequest; 

interface RatingRepositoryInterface
{
    public function createRating(CreateRatingRequest $request);
    public function updateRating(UpdateRatingRequest $request, $id);
    public function deleteRating($id);
    public function getRatingById($id);
    public function getAllRatings();
    public function getRatingsByProduitId($produitId);
    public function getRatingsByUserId($userId);
    
}

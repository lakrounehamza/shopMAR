<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Repositories\RatingRepository;
class RatingController extends Controller
{
    protected $ratingRepository;

    public function __construct(RatingRepository $ratingRepository)
    {
        $this->ratingRepository = $ratingRepository;
    }
    public function index()
    {
        $ratings = $this->ratingRepository->getAllRatings();
        return response()->json($ratings);
    }

    public function show($id)
    {
        $rating = $this->ratingRepository->getRatingById($id);
        if (!$rating) {
            return response()->json(['message' => 'Rating not found'], 404);
        }
        return response()->json($rating);
    }

    public function store(CreateRatingRequest $request)
    {
        $rating = $this->ratingRepository->createRating($request);
        return response()->json($rating, 201);
    }

    public function update(UpdateRatingRequest $request, $id)
    {
        $rating = $this->ratingRepository->updateRating($request, $id);
        if (!$rating) {
            return response()->json(['message' => 'Rating not found'], 404);
        }
        return response()->json($rating);
    }

    public function destroy($id)
    {
        $this->ratingRepository->deleteRating($id);
        return response()->json(['message' => 'Rating deleted successfully'], 200);
    }

    public function getRatingsByProduitId($produitId)
    {
        $ratings = $this->ratingRepository->getRatingsByProduitId($produitId);
        return response()->json($ratings);
    }

    public function getRatingsByUserId($userId)
    {
        $ratings = $this->ratingRepository->getRatingsByUserId($userId);
        return response()->json($ratings);
    }
}

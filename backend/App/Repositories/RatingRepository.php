<?php

namespace App\Repositories;
use App\Repositories\Interfaces\RatingRepositoryInterface;
use App\Http\Requests\CreateRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Models\Rating;
class RatingRepository implements RatingRepositoryInterface
{
    public function createRating(CreateRatingRequest $request){
        $rating = Rating::create([
            'user_id' => $request->user_id,
            'produit_id' => $request->produit_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        return response()->json([
            'message' => 'Rating created successfully',
            'data' => $rating
        ], 201);
    }
    public function updateRating(UpdateRatingRequest $request, $id){
        $rating = Rating::findOrFail($id);
        $rating->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        return response()->json([
            'message' => 'Rating updated successfully',
            'data' => $rating
        ], 200);
    }
    public function deleteRating($id){
        $rating = Rating::findOrFail($id);
        $rating->delete();
        return response()->json([
            'message' => 'Rating deleted successfully'
        ], 200);
    }
    public function getRatingById($id){
        $rating = Rating::findOrFail($id);
        return response()->json([
            'data' => $rating
        ], 200);
    }
    public function getAllRatings(){
        $ratings = Rating::all();
        return response()->json([
            'data' => $ratings
        ], 200);
    }
    public function getRatingsByProduitId($produitId){
        $ratings = Rating::where('produit_id', $produitId)->get();
        return response()->json([
            'data' => $ratings
        ], 200);
    }
    public function getRatingsByUserId($userId){
        $ratings = Rating::where('user_id', $userId)->get();
        return response()->json([
            'data' => $ratings
        ], 200);
    }
}

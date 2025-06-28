<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProduitController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware([CheckRole::class . ':admin'])->group(function () {
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{id}', [CategoryController::class, 'show']);
    Route::post('categories', [CategoryController::class, 'store']);
    Route::put('categories/{id}', [CategoryController::class, 'update']);
    Route::delete('categories/{id}', [CategoryController::class, 'destroy']);
    Route::get('categories/name/{name}', [CategoryController::class, 'findByName']);
    Route::get('categories-with-products', [CategoryController::class, 'categoriesWithProducts']);
    Route::get('produits', [ProduitController::class, 'index']);
    Route::get('produits/{id}', [ProduitController::class, 'show']);
    Route::post('produits', [ProduitController::class, 'store']);
    Route::put('produits/{id}', [ProduitController::class, 'update']);
    Route::delete('produits/{id}', [ProduitController::class, 'destroy']);
    Route::get('produits/name/{name}', [ProduitController::class, 'findByName']);
    Route::get('produits-with-categories', [ProduitController::class, 'produitsWithCategories']);
    Route::get('produits/category/{categoryId}', [ProduitController::class, 'produitsByCategoryId']);
    Route::get('produits/category/name/{categoryName}', [ProduitController::class, 'produitsByCategoryName']);
    
});

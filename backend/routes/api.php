<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProduitController;
use App\Http\Controllers\API\TypeProduitController;
use App\Http\Controllers\API\RatingController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\LivreurController;
use App\Http\Controllers\API\PaiementController;
use App\Http\Controllers\API\CommandeController;
use App\Http\Controllers\API\LivraisonController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('clients', [ClientController::class, 'store']);
Route::post('livreurs', [LivreurController::class, 'store']);
Route::post('forgot', [AuthController::class, 'forgot']);
Route::post('reset', [AuthController::class, 'reset']);

Route::middleware([CheckRole::class  ])->group(function () {
Route::post('logout', [AuthController::class, 'logout']);
});
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
    Route::get('type-produits', [TypeProduitController::class, 'index']);
    Route::get('type-produits/{id}', [TypeProduitController::class, 'show']);
    Route::post('type-produits', [TypeProduitController::class, 'store']);
    Route::put('type-produits/{id}', [TypeProduitController::class, 'update']);
    Route::delete('type-produits/{id}', [TypeProduitController::class, 'destroy']);
    Route::get('type-produits/name/{name}', [TypeProduitController::class, 'findByName']);
    Route::get('type-produits-with-produits', [TypeProduitController::class, 'typeProduitsWithProduits']);
    Route::get('type-produits/produit/{produitId}', [TypeProduitController::class, 'typeProduitsByProduitId']);
    Route::get('type-produits/produit/category/{categoryId}', [TypeProduitController::class, 'typeProduitsByProduitCategoryId']);
    Route::get('type-produits/produit/category/name/{categoryName}', [TypeProduitController::class, 'typeProduitsByProduitCategoryName']);
    Route::get('ratings', [RatingController::class, 'index']);
    Route::get('ratings/{id}', [RatingController::class, 'show']);
    Route::post('ratings', [RatingController::class, 'store']);
    Route::put('ratings/{id}', [RatingController::class, 'update']);
    Route::delete('ratings/{id}', [RatingController::class, 'destroy']);
    Route::get('ratings/produit/{produitId}', [RatingController::class, 'getRatingsByProduitId']);
    Route::get('ratings/user/{userId}', [RatingController::class, 'getRatingsByUserId']);

    Route::get('clients', [ClientController::class, 'index']);
    Route::get('clients/search', [ClientController::class, 'search']);
    Route::get('clients/user/{userId}', [ClientController::class, 'getClientsByUserId']);
});

Route::middleware([CheckRole::class . ':client'])->group(function () {
    Route::get('clients/{id}', [ClientController::class, 'show']);
    Route::put('clients/{id}', [ClientController::class, 'update']);
    Route::delete('clients/{id}', [ClientController::class, 'destroy']);

    Route::get('commandes/livreur/{livreurId}', [CommandeController::class, 'getCommandesByLivreurId']);
    Route::put('commandes/{id}/livraison', [LivraisonController::class, 'updateLivraisonStatus']);
    Route::get('livraisons/livreur/{livreurId}', [LivraisonController::class, 'getLivraisonsByLivreurId']);
});

    Route::post('commandes', [CommandeController::class, 'store']);


// Route::middleware([CheckRole::class . ':livreur'])->group(function () {
//     Route::put('livreurs/{id}', [LivreurController::class, 'update']);
//     Route::delete('livreurs/{id}', [LivreurController::class, 'destroy']);
//     Route::get('livreurs/{id}', [LivreurController::class, 'show']);
//     Route::get('livreurs', [LivreurController::class, 'index']);
//     Route::get('livreurs/search', [LivreurController::class, 'search']);
//     Route::get('livreurs/user/{userId}', [LivreurController::class, 'getLivreursByUserId']);
//     Route::get('livreurs/zone/{zoneTravail}', [LivreurController::class, 'getLivreursByZoneTravail']);
//     Route::get('livreurs/disponibles', [LivreurController::class, 'getLivreursDisponibles']);
// });



Route::prefix('paiements')->group(function () {
    Route::get('/', [PaiementController::class, 'index']);  
    Route::post('/', [PaiementController::class, 'store']);  
    Route::get('/{id}', [PaiementController::class, 'show']);  
    Route::put('/{id}', [PaiementController::class, 'update']);  
    Route::delete('/{id}', [PaiementController::class, 'destroy']);  

    // Filtres
    Route::get('/commande/{id_commande}', [PaiementController::class, 'getByCommande']);
    Route::get('/status/{status}', [PaiementController::class, 'getByStatus']);
    Route::get('/mode/{mode_paiement}', [PaiementController::class, 'getByModePaiement']);
    Route::get('/transaction/{transaction_id}', [PaiementController::class, 'getByTransactionId']);
    Route::get('/paypal/order/{paypal_order_id}', [PaiementController::class, 'getByPaypalOrderId']);

    // Paiement PayPal
    Route::post('/paypal/create', [PaiementController::class, 'createPaypalPayment']);
    Route::post('/paypal/capture', [PaiementController::class, 'capturePaypalPayment']);
    Route::post('/paypal/webhook', [PaiementController::class, 'paypalWebhook']); // PayPal webhook (POST)

    // Autres opérations
    Route::post('/{id}/refund', [PaiementController::class, 'refund']); // Remboursement
    Route::post('/{id}/cancel', [PaiementController::class, 'cancel']); // Annuler paiement

    // Statistiques
    Route::get('/stats', [PaiementController::class, 'getStats']);
});

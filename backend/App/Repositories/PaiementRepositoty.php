<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PaiementRepositoryInterface;
use App\Http\Requests\CreatePaiementRequest;
use App\Http\Requests\UpdatePaiementRequest;
use App\Models\Paiement;
use App\Services\PaypalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Exception;

class PaiementRepository implements PaiementRepositoryInterface
{
    public function getAll()
    {
        try {
            $paiements = Paiement::all();
            return response()->json([
                'success' => true,
                'data' => $paiements
            ], 200);
        } catch (Exception $e) {
            Log::error('Error fetching paiements: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch paiements'
            ], 500);
        }
    }
    public function getById($id)
    {
        try {
            $paiement = Paiement::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $paiement
            ], 200);
        } catch (Exception $e) {
            Log::error('Error fetching paiement: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Paiement not found'
            ], 404);
        }
    }
    public function create(CreatePaiementRequest $request)
    {
        try {
            $paiement = Paiement::create([
                'id_commande' => $request->id_commande,
                'montant' => $request->montant,
                'mode_paiement' => $request->mode_paiement,
                'status' => $request->status,
                'transaction_id' => $request->transaction_id,
            ]);
            return response()->json([
                'success' => true,
                'data' => $paiement
            ], 201);
        } catch (Exception $e) {
            Log::error('Error creating paiement: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create paiement'
            ], 500);
        }
    }
    public function update($id, UpdatePaiementRequest $request)
    {
        try {
            $paiement = Paiement::findOrFail($id);
            $paiement->update([
                'montant' => $request->montant,
                'mode_paiement' => $request->mode_paiement,
                'status' => $request->status,
                'transaction_id' => $request->transaction_id,
            ]);
            return response()->json([
                'success' => true,
                'data' => $paiement
            ], 200);
        } catch (Exception $e) {
            Log::error('Error updating paiement: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update paiement'
            ], 500);
        }
    }
    public function delete($id)
    {
        try {
            $paiement = Paiement::findOrFail($id);
            $paiement->delete();
            return response()->json([
                'success' => true,
                'message' => 'Paiement deleted successfully'
            ], 200);
        } catch (Exception $e) {
            Log::error('Error deleting paiement: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete paiement'
            ], 500);
        }
    }
    public function getByCommandeId($id_commande)
    {
        try {
            $paiements = Paiement::where('id_commande', $id_commande)->get();
            return response()->json([
                'success' => true,
                'data' => $paiements
            ], 200);
        } catch (Exception $e) {
            Log::error('Error fetching paiements by commande ID: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch paiements by commande ID'
            ], 500);
        }
    }
    public function getByStatus($status)
    {
        try {
            $paiements = Paiement::where('status', $status)->get();
            return response()->json([
                'success' => true,
                'data' => $paiements
            ], 200);
        } catch (Exception $e) {
            Log::error('Error fetching paiements by status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch paiements by status'
            ], 500);
        }
    }
    public function getByModePaiement($mode_paiement)
    {
        try {
            $paiements = Paiement::where('mode_paiement', $mode_paiement)->get();
            return response()->json([
                'success' => true,
                'data' => $paiements
            ], 200);
        } catch (Exception $e) {
            Log::error('Error fetching paiements by mode paiement: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch paiements by mode paiement'
            ], 500);
        }
    }
    public  function getByTransactionId($transaction_id)
    {
        try {
            $paiements = Paiement::where('transaction_id', $transaction_id)->get();
            return response()->json([
                'success' => true,
                'data' => $paiements
            ], 200);
        } catch (Exception $e) {
            Log::error('Error fetching paiements by transaction ID: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch paiements by transaction ID'
            ], 500);
        }
    }
    public function processPaypalPayment(CreatePaiementRequest $request)
    {
        // try {
        //     $paypalService = new PaypalService();
        //     $response = $paypalService->createPayment($request->all());

        //     if ($response['success']) {
        //         return response()->json([
        //             'success' => true,
        //             'data' => $response['data']
        //         ], 201);
        //     } else {
        //         return response()->json([
        //             'success' => false,
        //             'message' => $response['message']
        //         ], 400);
        //     }
        // } catch (Exception $e) {
        //     Log::error('Error processing PayPal payment: ' . $e->getMessage());
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Failed to process PayPal payment'
        //     ], 500);
        // }
    }
    public function capturePaypalPayment($transaction_id)
    {
        // try {
        //     $paypalService = new PaypalService();
        //     $response = $paypalService->capturePayment($transaction_id);
        //     if ($response['success']) {
        //         return response()->json([
        //             'success' => true,
        //             'data' => $response['data']
        //         ], 200);
        //     } else {
        //         return response()->json([
        //             'success' => false,
        //             'message' => $response['message']
        //         ], 400);
        //     }
        // } catch (Exception $e) {
        //     Log::error('Error capturing PayPal payment: ' . $e->getMessage());
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Failed to capture PayPal payment'
        //     ], 500);
        // }
    }
}

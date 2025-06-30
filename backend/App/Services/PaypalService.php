<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class PaypalService
{
    private $clientId;
    private $clientSecret;
    private $baseUrl;
    private $accessToken;

    public function __construct()
    {
        $this->clientId = config('services.paypal.client_id');
        $this->clientSecret = config('services.paypal.client_secret');
        $this->baseUrl = config('services.paypal.base_url', 'https://api-m.sandbox.paypal.com');
    }

    /**
     * Obtenir un token d'accès PayPal
     */
    private function getAccessToken(): ?string
    {
        if ($this->accessToken) {
            return $this->accessToken;
        }

        try {
            $response = Http::withBasicAuth($this->clientId, $this->clientSecret)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Accept-Language' => 'en_US',
                ])
                ->asForm()
                ->post($this->baseUrl . '/v1/oauth2/token', [
                    'grant_type' => 'client_credentials'
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $this->accessToken = $data['access_token'];
                return $this->accessToken;
            }

            Log::error('Erreur lors de l\'obtention du token PayPal: ' . $response->body());
            return null;
        } catch (Exception $e) {
            Log::error('Exception lors de l\'obtention du token PayPal: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Créer un ordre PayPal
     */
    public function createOrder(array $data): array
    {
        try {
            $token = $this->getAccessToken();
            if (!$token) {
                return ['success' => false, 'message' => 'Impossible d\'obtenir le token PayPal'];
            }

            $orderData = [
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    [
                        'amount' => [
                            'currency_code' => $data['devise'] ?? 'EUR',
                            'value' => number_format($data['montant'], 2, '.', '')
                        ],
                        'description' => $data['description'] ?? 'Paiement commande #' . $data['id_commande']
                    ]
                ],
                'application_context' => [
                    'return_url' => $data['return_url'] ?? config('app.url') . '/payment/success',
                    'cancel_url' => $data['cancel_url'] ?? config('app.url') . '/payment/cancel',
                    'brand_name' => $data['brand_name'] ?? config('app.name'),
                    'locale' => 'fr-FR',
                    'landing_page' => 'BILLING',
                    'user_action' => 'PAY_NOW'
                ]
            ];

            $response = Http::withToken($token)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'PayPal-Request-Id' => uniqid()
                ])
                ->post($this->baseUrl . '/v2/checkout/orders', $orderData);

            if ($response->successful()) {
                $responseData = $response->json();
                $approvalUrl = collect($responseData['links'])
                    ->firstWhere('rel', 'approve')['href'] ?? null;

                return [
                    'success' => true,
                    'order_id' => $responseData['id'],
                    'approval_url' => $approvalUrl,
                    'status' => $responseData['status']
                ];
            }

            Log::error('Erreur lors de la création de l\'ordre PayPal: ' . $response->body());
            return ['success' => false, 'message' => 'Erreur lors de la création de l\'ordre PayPal'];
        } catch (Exception $e) {
            Log::error('Exception lors de la création de l\'ordre PayPal: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Exception lors de la création de l\'ordre PayPal'];
        }
    }

    /**
     * Capturer un ordre PayPal
     */
    public function captureOrder(string $orderId): array
    {
        try {
            $token = $this->getAccessToken();
            if (!$token) {
                return ['success' => false, 'message' => 'Impossible d\'obtenir le token PayPal'];
            }

            $response = Http::withToken($token)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])
                ->post($this->baseUrl . "/v2/checkout/orders/{$orderId}/capture");

            if ($response->successful()) {
                $responseData = $response->json();
                $captureData = $responseData['purchase_units'][0]['payments']['captures'][0] ?? null;

                if ($captureData) {
                    return [
                        'success' => true,
                        'capture_id' => $captureData['id'],
                        'status' => $captureData['status'],
                        'amount' => $captureData['amount']['value'],
                        'payer_id' => $responseData['payer']['payer_id'] ?? null,
                        'transaction_id' => $captureData['id']
                    ];
                }
            }

            Log::error('Erreur lors de la capture de l\'ordre PayPal: ' . $response->body());
            return ['success' => false, 'message' => 'Erreur lors de la capture de l\'ordre PayPal'];
        } catch (Exception $e) {
            Log::error('Exception lors de la capture de l\'ordre PayPal: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Exception lors de la capture de l\'ordre PayPal'];
        }
    }

    /**
     * Rembourser une capture PayPal
     */
    public function refundCapture(string $captureId, float $amount = null): array
    {
        try {
            $token = $this->getAccessToken();
            if (!$token) {
                return ['success' => false, 'message' => 'Impossible d\'obtenir le token PayPal'];
            }

            $refundData = [];
            if ($amount !== null) {
                $refundData['amount'] = [
                    'value' => number_format($amount, 2, '.', ''),
                    'currency_code' => 'EUR'
                ];
            }

            $response = Http::withToken($token)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])
                ->post($this->baseUrl . "/v2/payments/captures/{$captureId}/refund", $refundData);

            if ($response->successful()) {
                $responseData = $response->json();
                return [
                    'success' => true,
                    'refund_id' => $responseData['id'],
                    'status' => $responseData['status'],
                    'amount' => $responseData['amount']['value'] ?? $amount
                ];
            }

            Log::error('Erreur lors du remboursement PayPal: ' . $response->body());
            return ['success' => false, 'message' => 'Erreur lors du remboursement PayPal'];
        } catch (Exception $e) {
            Log::error('Exception lors du remboursement PayPal: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Exception lors du remboursement PayPal'];
        }
    }

    /**
     * Obtenir les détails d'un ordre PayPal
     */
    public function getOrderDetails(string $orderId): array
    {
        try {
            $token = $this->getAccessToken();
            if (!$token) {
                return ['success' => false, 'message' => 'Impossible d\'obtenir le token PayPal'];
            }

            $response = Http::withToken($token)
                ->withHeaders([
                    'Accept' => 'application/json',
                ])
                ->get($this->baseUrl . "/v2/checkout/orders/{$orderId}");

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json()
                ];
            }

            return ['success' => false, 'message' => 'Ordre introuvable'];
        } catch (Exception $e) {
            Log::error('Exception lors de la récupération des détails de l\'ordre PayPal: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Exception lors de la récupération des détails'];
        }
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommandeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:clients,id',
            'status' => 'required|in:in_progress,paid,delivered,cancelled',
            'payment_method' => 'required|in:paypal,cash_on_delivery',
            'total_prix' => 'required|numeric|min:0',
        ];
    }
}

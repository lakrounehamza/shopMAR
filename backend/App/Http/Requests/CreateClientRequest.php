<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends FormRequest
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
            'id_user' => 'required|integer|exists:users,id',
            'adresseVille' => 'required|string|max:255',
            'adresseRue' => 'required|string|max:255',
            'adresseCodePostal' => 'required|string|max:20',
            'adressePays' => 'required|string|max:100',
        ];
    }
}

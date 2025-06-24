<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user','livreur', 
            'telephone' => 'required|stringsize:10|unique:users,telephone',
            'zoneTravail' => 'nullebal|string|max:255',
            'disponibe' => 'nullebal|boolean',
            'adresseRue' => 'nullebal|string|max:255',
            'adressecodePostal' => 'nullebal|string|max:10',
            'adresseville' => 'nullebal|string|max:100',
            'adressepays' => 'nullebal|string|max:100',
        ];
    }
}

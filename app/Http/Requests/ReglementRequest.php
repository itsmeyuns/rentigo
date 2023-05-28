<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReglementRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'date_reglement' => 'required | date | before_or_equal:today',
            'montant' => 'required | numeric',
            'type' => 'required | string',
            'contrat_id' => 'required | exists:contrats,id'
        ];
    }

    public function messages()
    {
        return [
            'date_reglement.before_or_equal' => "Le champ date reglement doit être une date antérieure ou égale à la date d'aujourd'hui.",
            'contrat_id.exists' => 'Numéro de contrat est invalide'
        ];
    }

    public function faildValidation(Validator $validator)
    {
        // Return validation errors if validation fails
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'validation error',
            'errors' => $validator->errors()
        ], 422));
    }
}

<?php

namespace App\Http\Requests;

use App\Rules\CheckDateReservation;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ReservationRequest extends FormRequest
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
            'date_reservation' => 'required | date ',
            'date_debut' => ['required', 'date' , 'after_or_equal:today', new CheckDateReservation($this->id)],
            'date_fin' => 'required | date | after:date_debut',
            'commentaire' => 'nullable',
            'client_id' => 'required|exists:clients,id',
            'vehicule_id' => 'required|exists:vehicules,id',
            'status' => 'required | string'
        ];
    }

    public function messages(): array
    {
        return [
            'client_id.exists' => 'Le client sélectionné est invalide.',
            'vehicule_id.exists' => 'Le client sélectionnée est invalide.',
            'date_debut.after_or_equal' => "Le champ date de début doit être une date postérieure ou égale à aujourd'hui."
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


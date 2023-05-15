<?php

namespace App\Http\Requests;

use App\Models\Contrat;
use App\Rules\CheckDateContrat;
use App\Rules\CheckStatusVehicule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContratRequest extends FormRequest
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
        $date_contrat = 'today';
        // On Update
        if ($this->id) {
            $reservation = Contrat::find($this->id);
            $date_contrat = $reservation->date_contrat;
        }
        return [
            'date_contrat' => "required | date | date_equals:".$date_contrat,
            'date_debut' => ['required', 'date' , 'after_or_equal:date_contrat', new CheckDateContrat($this->id)],
            'date_fin' => 'required | date | after:date_debut',
            'client_id' => 'required|exists:clients,id',
            'vehicule_id' => ['required', 'exists:vehicules,id', new CheckStatusVehicule($this->id)]
        ];
    }

    public function messages(): array
    {
        return [
            'client_id.exists' => 'Le client sélectionné est invalide.',
            'vehicule_id.exists' => 'Le vehicule sélectionné est invalide.',
            'date_debut.after_or_equal' => "Le champ date de début doit être une date postérieure ou égale la date de contrat"
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

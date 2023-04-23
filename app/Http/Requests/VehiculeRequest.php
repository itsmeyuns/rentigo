<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class VehiculeRequest extends FormRequest
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
            'matricule' => ['required', 'string', 'max:30', Rule::unique('vehicule')->ignore($this->id)],
            'marque' => 'required | string | max:100',
            'modele' => 'required | string | max:80',
            'couleur' => 'required | string | max:40',
            'kilometrage' => 'required | integer | min:0',
            'carburant' => 'required | string | max:40',
            'automatique' => 'required | string | max:3',
            'prix_location' => 'required | numeric | min:0',
            'photo' => 'nullable | text',
            'nombre_portes' => 'required | integer | min:1',
            'nombre_places' => 'required | integer | min:1',
            'diponibilite' => 'required | string | max:50',
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

<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
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
            'nom' => 'required | string | max:80',
            'prenom' => 'required | string | max:80',
            'sexe' => 'required | string | max:1 | in:H,F',
            'date_naissance' => 'required | date',
            'lieu_naissance' => 'required | string',
            'adresse' => 'required | string',
            'cin' => ['required', 'string', 'max:20', Rule::unique('clients')->ignore($this->id)],
            'telephone' => ['required', 'string', 'max:20', 'regex:/^(?:\+\d{1,3})?[-.\s]?\(?\d{1,3}\)?[-.\s]?\d{6,12}$/',Rule::unique('clients')->ignore($this->id)],
            'email' => ['nullable', 'email', Rule::unique('clients')->ignore($this->id)],
            'numero_permis' => ['required', 'string', Rule::unique('clients')->ignore($this->id)],
            'observation' => 'nullable'
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


<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            // 'sexe' => 'required | string | max:1',
            // 'date_naissance' => 'required | date',
            // 'lieu_naissance' => 'required | string',
            // 'cin' => 'required | string | max:20 | unique:clients',
            // 'telephone' => 'required | string | max:20 | unique:clients',
            // 'email' => 'unique:clients',
            // 'numero_permis' => 'required | string | unique:clients',
            // 'observation' => ''
        ];
    }
}

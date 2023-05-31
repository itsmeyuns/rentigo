<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgenceRequest extends FormRequest
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
            'raison_sociale' => ['required', 'max:255'],
            'adresse' => ['required'],
            'ville' => ['required', 'max:255'],
            'telephone' => ['required', 'numeric', 'min:10'],
            'fax' => ['required', 'numeric', 'min:10'],
            'email' => ['required', 'email'],
            'patent' => ['required', 'numeric'],
            'IF' => ['required', 'numeric'],
            'RC' => ['required', 'numeric'],
            'ICE' => ['required', 'numeric'],
            'CNSS' => ['required', 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'IF.required' => 'Le champ IF est obligatoire.',
            'RC.required' => 'Le champ RC est obligatoire.',
            'ICE.required' => 'Le champ ICE est obligatoire.',
            'CNSS.required' => 'Le champ CNSS est obligatoire.',
            'IF.numeric' => 'Le champ IF doit contenir un nombre.',
            'RC.numeric' => 'Le champ RC doit contenir un nombre.',
            'ICE.numeric' => 'Le champ ICE doit contenir un nombre.',
            'CNSS.numeric' => 'Le champ CNSS doit contenir un nombre.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChargeRequest extends FormRequest
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
            'date' => 'required | date | before_or_equal:today',
            'type' => 'required | string | ',
            'cout' => 'required | numeric',
            'observation' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            "date.before_or_equal" => "Le champ de date doit être une date antérieure ou égale à aujourd'hui."
        ];
    }
}

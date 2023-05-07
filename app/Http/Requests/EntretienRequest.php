<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EntretienRequest extends FormRequest
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
            'type' => 'required | string',
            'date' => 'required | date | before_or_equal:today',
            'km_actuel' => 'required | integer | min:0',
            'cout' => 'required | numeric | min:1',
            'observation' => 'nullable',
            'vehicule_id' => 'required | integer'
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

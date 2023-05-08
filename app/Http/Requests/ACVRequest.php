<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ACVRequest extends FormRequest
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
            'date_debut' => 'required | date',
            'date_fin' => 'required | date | after:date_debut',
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

<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $rules = [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'login' => ['required', 'string', 'max:30', Rule::unique('users')->ignore($this->id)->whereNull('deleted_at')],
            'sexe' => ['required', 'string', 'max:1', 'in:H,F'],
            'date_naissance' => ['required', 'string', 'date'],
            'lieu_naissance' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'cin' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($this->id)->whereNull('deleted_at')],
            'telephone' => ['required', 'string', 'regex:/^(?:\+\d{1,3})?[-.\s]?\(?\d{1,3}\)?[-.\s]?\d{6,12}$/', Rule::unique('users')->ignore($this->id)->whereNull('deleted_at')],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->id)->whereNull('deleted_at')],
            'login' => ['required', 'string', 'max:30', Rule::unique('users')->ignore($this->id)->whereNull('deleted_at')],
        ];
        if (!$this->id) {
            $rules['password'] = ['required', 'string', 'min:8'];
        }
        return $rules;
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

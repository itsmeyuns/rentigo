<?php

namespace App\Rules;

use App\Models\Contrat;
use App\Models\Vehicule;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckStatusVehicule implements DataAwareRule, ValidationRule
{
    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];
    protected $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Set the data under validation.
     *
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->id) {
            $status = Vehicule::find($this->data['vehicule_id'])->status;
            if (strtolower($status) !== 'disponible') {
                $fail("Ce véhicule est " . strtolower($status));
            }
        }
    }
}

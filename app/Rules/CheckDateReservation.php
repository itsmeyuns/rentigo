<?php

namespace App\Rules;

use App\Models\Reservation;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\DataAwareRule;


class CheckDateReservation implements DataAwareRule, ValidationRule
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
        //  checks if a vehicle is already reserved for the selected period
        $start = $value;
        $end = $this->data['date_fin'];
        $vehicule = $this->data['vehicule_id'];
        $reserved = Reservation::where('id', '!=', $this->id)
                                ->where('vehicule_id', $vehicule)
                                ->whereNotIn('status', ['Terminée', 'Annulée'])
                                ->where(function ($query) use ($start, $end) {
                                            $query->where(function ($query) use ($start, $end) {
                                                $query->where('date_debut', '<=', $start)
                                                    ->where('date_fin', '>=', $start);
                                            })
                                ->orWhere(function ($query) use ($start, $end) {
                                    $query->where('date_debut', '<=', $end)
                                        ->where('date_fin', '>=', $end);
                                })
                                ->orWhere(function ($query) use ($start, $end) {
                                    $query->where('date_debut', '>=', $start)
                                        ->where('date_fin', '<=', $end);  
                                });
                                })  
        ->exists();
        if ($reserved) {
            $fail('ce véhicule est déjà réservé pour la période sélectionnée.');
        }
    }
}

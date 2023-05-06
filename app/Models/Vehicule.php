<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Vehicule extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;
    protected $cascadeDeletes = ['vidanges', 'assurances', 'carteGrises', 'visiteTechniques'];
    protected $fillable = [
        'matricule',
        'marque',
        'modele',
        'couleur',
        'kilometrage',
        'carburant',
        'automatique',
        'prix_location',
        'photo',
        'nombre_portes',
        'nombre_places',
        'status',
    ];

    public function extras()
    {
        return $this->belongsToMany(Extra::class);
    }

    public function vidanges() {
        return $this->hasMany(Vidange::class);
    }

    public function carteGrises()
    {
        return $this->hasMany(CarteGrise::class);
    }

    public function assurances()
    {
        return $this->hasMany(Assurance::class);
    }

    public function visiteTechniques()
    {
        return $this->hasMany(VisiteTechnique::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicule extends Model
{
    use HasFactory, SoftDeletes;
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
        'diponibilite',
    ];
}

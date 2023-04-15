<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'prenom',
        'sexe',
        'numero_permis',
        'date_naissance',
        'lieu_naissance',
        'adresse',
        'cin',
        'telephone',
        'email',
        'observation',
    ];
}

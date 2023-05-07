<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entretien extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'type',
        'date',
        'km_actuel',
        'cout',
        'observation',
        'vehicule_id'
    ];
}

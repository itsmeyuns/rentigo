<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarteGrise extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'date_debut',
        'date_fin',
        'vehicule_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vidange extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'date',
        'km_actuel',
        'km_prochain_vidange',
        'cout',
        'observation',
        'vehicule_id'
    ];
}

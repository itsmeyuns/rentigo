<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisiteTechnique extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_debut',
        'date_fin',
        'vehicule_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vidange extends Model
{
    use HasFactory, SoftDeletes;
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    use HasFactory;

    protected $fillable = [
        'raison_sociale',
        'adresse',
        'ville',
        'telephone',
        'fax',
        'email',
        'patent',
        'IF',
        'RC',
        'ICE',
        'CNSS',
    ];

    public function representantLegal()
    {
        return $this->hasOne(RepresentantLegal::class);
    }

}

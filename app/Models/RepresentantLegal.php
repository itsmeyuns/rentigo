<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentantLegal extends Model
{
    use HasFactory;

    protected $table = 'representant_legal';

    protected $fillable = [
        'nom',
        'prenom',
        'cin',
        'agence_id',
    ];

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }

}

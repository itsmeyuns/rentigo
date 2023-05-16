<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reglement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date_reglement',
        'montant',
        'type',
        'contrat_id'
    ];

    public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }
}

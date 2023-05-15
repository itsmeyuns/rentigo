<?php

namespace App\Models;

use App\Events\ContratDeleted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date_contrat',
        'date_debut',
        'heure_debut',
        'date_fin',
        'heure_fin',
        'vehicule_id',
        'client_id',
        'user_id',
    ];

    protected $dispatchesEvents = [
        'deleted' => ContratDeleted::class
    ];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

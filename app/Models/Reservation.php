<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'date_reservation',
        'date_debut',
        'heure_debut',
        'date_fin',
        'heure_fin',
        'commentaire',
        'vehicule_id',
        'client_id',
        'user_id',
        'status'
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

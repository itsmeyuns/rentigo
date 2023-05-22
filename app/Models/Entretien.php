<?php

namespace App\Models;

use App\Events\EntretienCreated;
use App\Events\EntretienDeleted;
use App\Events\EntretienUpdated;
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
    protected $dispatchesEvents = [
        'created' => EntretienCreated::class,
        'deleted' => EntretienDeleted::class,
        'updated' => EntretienUpdated::class,
    ];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }
}

<?php

namespace App\Models;

use App\Events\VidangeCreated;
use App\Events\VidangeDeleted;
use App\Events\VidangeUpdated;
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
    protected $dispatchesEvents = [
        'created' => VidangeCreated::class,
        'deleted' => VidangeDeleted::class,
        'updated' => VidangeUpdated::class
    ];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }
}

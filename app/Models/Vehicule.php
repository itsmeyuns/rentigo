<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicule extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'matricule',
        'marque',
        'modele',
        'couleur',
        'kilometrage',
        'carburant',
        'automatique',
        'prix_location',
        'photo',
        'nombre_portes',
        'nombre_places',
        'status',
    ];

    public function extras()
    {
        return $this->belongsToMany(Extra::class);
    }

    public function vidanges() {
        return $this->hasMany(Vidange::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Event triggered before the deletion of the Vehicle model
        static::deleting(function ($vehicule) {
            // Delete all instances of Vidange associated with this Vehicle model
            $vehicule->vidanges()->delete();
        });
    }


}

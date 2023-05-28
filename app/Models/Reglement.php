<?php

namespace App\Models;

use App\Events\ReglementCreated;
use App\Events\ReglementDeleted;
use App\Events\ReglementUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Reglement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date_reglement',
        'montant',
        'type',
        'contrat_id'
    ];

    protected $dispatchesEvents = [
        'created' => ReglementCreated::class,
        'deleted' => ReglementDeleted::class,
        'updated' => ReglementUpdated::class,
    ];

    public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }


    public function scopeamountPaidContrat($query, $contratId)
    {
        return $query->select(DB::raw('SUM(montant) as total'))
                    ->where('contrat_id', $contratId)
                    ->first();
    }

}

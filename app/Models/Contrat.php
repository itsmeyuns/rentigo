<?php

namespace App\Models;

use App\Events\ContratDeleted;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Contrat extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;
    protected $cascadeDeletes = ['reglements'];
    protected $fillable = [
        'date_contrat',
        'date_debut',
        'heure_debut',
        'date_fin',
        'heure_fin',
        'status',
        'terminee',
        'vehicule_id',
        'client_id',
        'user_id',
    ];

    protected $dispatchesEvents = [
        'deleted' => ContratDeleted::class
    ];


    public static function getPaidContrats()
    {
        return Contrat::with(['user:id,nom,prenom', 'vehicule:id,matricule,marque', 'client:id,nom,prenom'])
        ->join('vehicules', 'contrats.vehicule_id', '=', 'vehicules.id')
        ->join('reglements', 'contrats.id', '=', 'reglements.contrat_id')
        ->groupBy('contrats.id')
        ->havingRaw('SUM(reglements.montant) = (vehicules.prix_location * DATEDIFF(contrats.date_fin, contrats.date_debut))')
        ->get();
    }

    public static function getUnpaidContrats()
    {
        return self::with(['user:id,nom,prenom', 'vehicule:id,matricule,marque', 'client:id,nom,prenom'])
                    ->leftJoinSub(function ($query) {
                        $query->select('contrat_id', DB::raw('SUM(montant) AS total_amount'))
                            ->from('reglements')
                            ->groupBy('contrat_id');
                    }, 'payment_totals', 'contrats.id', '=', 'payment_totals.contrat_id')
                    ->join('vehicules', 'contrats.vehicule_id', '=', 'vehicules.id')
                    ->where(function ($query) {
                        $query->whereNull('payment_totals.contrat_id')
                            ->orWhereColumn('payment_totals.total_amount', '<', DB::raw('(vehicules.prix_location * DATEDIFF(contrats.date_fin, contrats.date_debut))'));
                    })
                    ->get();
    }

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

    public function reglements()
    {
        return $this->hasMany(Reglement::class);
    }

}

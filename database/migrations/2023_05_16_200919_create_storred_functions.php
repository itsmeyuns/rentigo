<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE FUNCTION montant_contrat (contrat_id FLOAT)
            RETURNS FLOAT
            BEGIN
                DECLARE jours int;
                DECLARE prix_location float; 
                SET jours = (SELECT DATEDIFF(date_fin, date_debut) AS diff_in_days FROM contrats WHERE id = contrat_id);
                SET prix_location = (   SELECT vehicules.prix_location FROM vehicules 
                                        INNER JOIN contrats
                                        on vehicules.id = contrats.vehicule_id
                                        WHERE contrats.id = contrat_id
                                    );
                RETURN prix_location * jours;
            END;
        ');
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS montant_contrat;');
    }
};

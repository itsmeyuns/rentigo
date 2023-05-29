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
        DB::unprepared('DROP PROCEDURE IF EXISTS get_visite_techniques;');
        DB::unprepared('DROP PROCEDURE IF EXISTS get_carte_grises;');
        DB::unprepared('DROP PROCEDURE IF EXISTS get_assurances;');
        // Viste Techniques
        DB::unprepared('
            CREATE PROCEDURE get_visite_techniques()
            BEGIN
                SELECT vehicules.id AS vehicule_id, vehicules.marque, vehicules.matricule, visite_techniques.id, visite_techniques.date_debut, visite_techniques.date_fin, DATEDIFF(visite_techniques.date_fin, CURRENT_DATE) AS reste FROM visite_techniques
                INNER JOIN vehicules
                ON visite_techniques.vehicule_id = vehicules.id
                WHERE DATEDIFF(visite_techniques.date_fin, CURRENT_DATE) <= 15
                AND visite_techniques.id  in (SELECT MAX(visite_techniques.id) FROM visite_techniques WHERE deleted_at is null GROUP bY vehicule_id );
            END;
        ');
        //Carte Grises
        DB::unprepared('
            CREATE PROCEDURE get_carte_grises()
            BEGIN
                SELECT vehicules.id AS vehicule_id, vehicules.marque, vehicules.matricule, carte_grises.id, carte_grises.date_debut, carte_grises.date_fin, DATEDIFF(carte_grises.date_fin, CURRENT_DATE) AS reste FROM carte_grises
                INNER JOIN vehicules
                ON carte_grises.vehicule_id = vehicules.id
                WHERE DATEDIFF(carte_grises.date_fin, CURRENT_DATE) <= 15
                AND carte_grises.id  in (SELECT MAX(carte_grises.id) FROM carte_grises WHERE deleted_at is null GROUP bY vehicule_id );
            END;
        ');
        //Assurances
        DB::unprepared('
            CREATE PROCEDURE get_assurances()
            BEGIN
                SELECT vehicules.id AS vehicule_id, vehicules.marque, vehicules.matricule, assurances.id, assurances.date_debut, assurances.date_fin, DATEDIFF(assurances.date_fin, CURRENT_DATE) AS reste FROM assurances
                INNER JOIN vehicules
                ON assurances.vehicule_id = vehicules.id
                WHERE DATEDIFF(assurances.date_fin, CURRENT_DATE) <= 15
                AND assurances.id  in (SELECT MAX(assurances.id) FROM assurances WHERE deleted_at is null GROUP bY vehicule_id );
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS get_visite_techniques;');
        DB::unprepared('DROP PROCEDURE IF EXISTS get_carte_grises;');
        DB::unprepared('DROP PROCEDURE IF EXISTS get_assurances;');
    }
};

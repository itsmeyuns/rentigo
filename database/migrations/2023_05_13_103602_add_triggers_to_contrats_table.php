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

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_contrats_changer_vehicule_status_on_insert`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_contrats_changer_vehicule_status_on_update`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_contrats_changer_vehicule_status_on_delete`');

        DB::unprepared('CREATE TRIGGER `trg_contrats_changer_vehicule_status_on_insert` AFTER INSERT ON `contrats` FOR EACH ROW
        BEGIN
            UPDATE vehicules set status = "Loué" WHERE id = NEW.vehicule_id;
        END
        ');

        DB::unprepared('CREATE TRIGGER `trg_contrats_changer_vehicule_status_on_update` AFTER UPDATE ON `contrats` FOR EACH ROW
        BEGIN
            UPDATE vehicules set status = "Disponible" WHERE id = OLD.vehicule_id;
            UPDATE vehicules set status = "Loué" WHERE id = NEW.vehicule_id;
        END
        ');
        
        DB::unprepared('CREATE TRIGGER `trg_contrats_changer_vehicule_status_on_delete` AFTER DELETE ON `contrats` FOR EACH ROW
        BEGIN
            UPDATE vehicules set status = "Disponible" WHERE id = OLD.vehicule_id;
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_contrats_changer_vehicule_status_on_insert`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_contrats_changer_vehicule_status_on_update`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_contrats_changer_vehicule_status_on_delete`');
    }
};

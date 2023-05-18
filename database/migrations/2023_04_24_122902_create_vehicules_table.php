<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('matricule', 30);
            $table->string('marque', 100);
            $table->string('modele', 80);
            $table->string('couleur', 40);
            $table->integer('kilometrage');
            $table->string('carburant', 40);
            $table->string('automatique', 3);
            $table->float('prix_location');
            $table->text('photo')->nullable()->default('pics/vehicules/deafult-vehicule.png');
            $table->integer('nombre_portes');
            $table->integer('nombre_places');
            $table->string('status', 50);
            $table->timestamps();
            $table->softDeletes();
            $table->string('matricule_unique')->virtualAs("CONCAT(matricule, '#',IF(deleted_at IS NULL, '-', deleted_at))")->invisible();
            $table->unique('matricule_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};

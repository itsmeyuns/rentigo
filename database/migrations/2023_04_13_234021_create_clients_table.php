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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 80);
            $table->string('prenom', 80);
            $table->string('sexe', 1);
            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->string('adresse');
            $table->string('cin', 20)->unique();
            $table->string('telephone', 20)->unique();
            $table->string('email')->unique()->nullable();
            $table->string('numero_permis')->unique();
            $table->text('observation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};

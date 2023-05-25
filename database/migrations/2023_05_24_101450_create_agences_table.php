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
        Schema::create('agences', function (Blueprint $table) {
            $table->id();
            $table->string('raison_sociale');
            $table->text('adresse');
            $table->string('ville');
            $table->string('telephone');
            $table->string('fax');
            $table->string('email');
            $table->string('patent');
            $table->string('IF');
            $table->string('RC');
            $table->string('ICE');
            $table->string('CNSS');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agences');
    }
};

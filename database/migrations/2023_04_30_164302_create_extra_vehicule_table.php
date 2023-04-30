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
        Schema::create('extra_vehicule', function (Blueprint $table) {
          $table->unsignedBigInteger('extra_id');
          $table->unsignedBigInteger('vehicule_id');
          $table->foreign('extra_id')
                ->references('id')
                ->on('extras')
                ->onDelete('cascade'); 
          $table->foreign('vehicule_id')
                ->references('id')
                ->on('vehicules')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extra_vehicule');
    }
};

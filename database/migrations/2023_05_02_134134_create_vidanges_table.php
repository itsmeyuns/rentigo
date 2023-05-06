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
      Schema::create('vidanges', function (Blueprint $table) {
        $table->id();
        $table->string('type');
        $table->date('date');
        $table->integer('km_actuel');
        $table->integer('km_prochain_vidange');
        $table->float('cout');
        $table->text('observation')->nullable()->default('');
        $table->unsignedBigInteger('vehicule_id');
        $table->foreign('vehicule_id')
              ->references('id')
              ->on('vehicules')
              ->onDelete('cascade');
        $table->timestamps();
        $table->softDeletes();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vidanges');
    }
};

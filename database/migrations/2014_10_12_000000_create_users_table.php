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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('login', 30);
            $table->string('role', 30);
            $table->string('sexe', 1);
            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->string('adresse');
            $table->string('cin', 20);
            $table->string('telephone');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->string('cin_unique')->virtualAs("CONCAT(cin, '#',IF(deleted_at IS NULL, '-', deleted_at))")->invisible();
            $table->unique('cin_unique');
            $table->string('telephone_unique')->virtualAs("CONCAT(telephone, '#',IF(deleted_at IS NULL, '-', deleted_at))")->invisible();
            $table->unique('telephone_unique');
            $table->string('email_unique')->virtualAs("CONCAT(email, '#',IF(deleted_at IS NULL, '-', deleted_at))")->invisible();
            $table->unique('email_unique');
            $table->string('login_unique')->virtualAs("CONCAT(login, '#',IF(deleted_at IS NULL, '-', deleted_at))")->invisible();
            $table->unique('login_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

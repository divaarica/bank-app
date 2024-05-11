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
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('numero');
            $table->string('nom');
            $table->string('prenom');
            $table->string('adresse');
            $table->integer('tel');
            $table->string('numeroCI');
            $table->string('email');
            $table->string('password');
            $table->integer('id_profil')->unsigned();
            $table->foreign('id_profil')->references('id')->on('profils');
            $table->integer('authentification');
            $table->integer('state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};

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
        Schema::create('cartes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('numero');
            $table->string('type');
            $table->integer('montant');
            $table->integer('cvv');
            $table->date('date_expiration');
            $table->integer('id_client')->unsigned();
            $table->foreign('id_client')->references('id')->on('utilisateurs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartes');
    }
};

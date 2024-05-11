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
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('code');
            $table->integer('id_compte_emetteur')->unsigned();
            $table->foreign('id_compte_emetteur')->references('id')->on('comptes');

            $table->integer('id_compte_destinataire')->unsigned();
            $table->foreign('id_compte_destinataire')->references('id')->on('comptes');

            $table->integer('id_emetteur')->unsigned();
            $table->foreign('id_emetteur')->references('id')->on('utilisateurs');
            $table->integer('id_destinataire')->unsigned();
            $table->foreign('id_destinataire')->references('id')->on('utilisateurs');
            $table->integer('montant');
            $table->integer('id_type')->unsigned();
            $table->foreign('id_type')->references('id')->on('type_transactions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

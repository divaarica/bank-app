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
        Schema::create('comptes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_type')->unsigned();
            $table->foreign('id_type')->references('id')->on('type_comptes');
            $table->integer('id_pack')->unsigned();
            $table->foreign('id_pack')->references('id')->on('packs');
            $table->string('numero');
            $table->integer('id_client')->unsigned();
            $table->foreign('id_client')->references('id')->on('utilisateurs');
            $table->integer('balance');
            $table->integer('state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes');
    }
};

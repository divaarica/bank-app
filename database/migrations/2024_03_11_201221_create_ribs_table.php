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
        Schema::create('ribs', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('codeBanque');
            $table->string('codeGuichet');
            $table->string('cleRib');
            $table->string('iban');
            $table->string('bic');
            $table->integer('id_compte')->unsigned();
            $table->foreign('id_compte')->references('id')->on('comptes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ribs');
    }
};

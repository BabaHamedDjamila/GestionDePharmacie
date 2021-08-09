<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('désignation');
            $table->string('nature');
            $table->string('catégorie');
            $table->integer('quantité');
            $table->float('prixUnit');
            $table->float('prixTotal');
            $table->float('marge');
            $table->string('nomClient');
            $table->dateTime('dateSorite');
            $table->string('vendeur');
            $table->float('RecetteJ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventes');
    }
}

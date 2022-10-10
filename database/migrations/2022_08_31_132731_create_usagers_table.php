<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usagers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('Nom');
            $table->text('nom_naissance');
            $table->text('prenom');
            $table->text('adresse');
            $table->text('cp');
            $table->text('ville');
            $table->text('tel');
            $table->text('email');
            $table->text('num_sécu');
            $table->text('Nnum_alloc');
            $table->text('categorie_sociopro');
            $table->text('autre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usagers');
    }
}

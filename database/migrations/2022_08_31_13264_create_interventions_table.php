<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interventions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('usager_id');
            $table->date('date_intervention');
            $table->text('oriente_par');
            $table->text('Type_intervention');
            $table->text('Organismes_acte_1');
            $table->text('Organismes_acte_2');
            $table->text('Organismes_acte_3');
            $table->text('oriente_vers');
            $table->text('resultat');
            $table->text('observation');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interventions');
    }
}

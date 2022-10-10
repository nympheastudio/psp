<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRdvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rdvs', function (Blueprint $table) {
            $table->id();

            $table->integer('poste_id');
            $table->integer('usager_id');
            $table->integer('mediateur_id');
            $table->date('date_rdv');
            $table->text('objet');
            $table->timestamps();
            /*
            SQLSTATE[42000]: Syntax error or access violation: 1075 Incorrect table definition; 
            there can be only one auto column and it must be defined as a key (SQL: create table 
            `rdvs` (`id` bigint unsigned not null auto_increment primary key, `poste_id` bigint unsigned not null auto_increment primary key, `usager_id` bigint unsigned not null auto_increment primary key, `mediateur_id` bigint unsigned not null auto_increment primary key, `date_rdv` date not null, `objet` text not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8 collate 'utf8_unicode_ci')
            */


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rdvs');
    }
}

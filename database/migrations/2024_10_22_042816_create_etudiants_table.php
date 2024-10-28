<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtudiantsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('etudiants')) {
            Schema::create('etudiants', function (Blueprint $table) {
                $table->unsignedBigInteger('Nce')->autoIncrement();
                $table->string('nci')->unique();
                $table->string('Nom');
                $table->string('Prenom');
                $table->date('DateNaissance');
                $table->string('CpLieuNaissance');
                $table->string('Adresse');
                $table->string('CpAdresse');
                $table->timestamps();
                $table->foreign('CpLieuNaissance')->references('cpVilles')->on('villes')->onDelete('cascade');
                $table->foreign('CpAdresse')->references('cpVilles')->on('villes')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('etudiants');
    }
}

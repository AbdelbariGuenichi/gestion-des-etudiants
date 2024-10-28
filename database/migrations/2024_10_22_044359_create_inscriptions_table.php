<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->string('Nce');
            $table->string('CodeSp');
            $table->date('DateInscription');
            $table->primary(['Nce', 'CodeSp', 'DateInscription']);
            $table->string('niveau');
            $table->string('resultatFinale');
            $table->string('Mention');
            $table->timestamps();
            $table->foreign('Nce')->references('nci')->on('etudiants')->onDelete('cascade');
            $table->foreign('CodeSp')->references('CodeSp')->on('specialites')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->string('Nce');
            $table->string('CodeMat');
            $table->date('DateResultat');
            $table->primary(['Nce', 'CodeMat', 'DateResultat']);
            $table->float('NoteControle');
            $table->float('NoteExamen');
            $table->string('resultat');
            $table->timestamps();
            $table->foreign('Nce')->references('Nci')->on('etudiants')->onDelete('cascade');
            $table->foreign('CodeMat')->references('CodeMat')->on('matieres')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notes');
    }
}

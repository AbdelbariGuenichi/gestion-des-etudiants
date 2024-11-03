<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->string('nci');
            $table->string('CodeMat');
            $table->date('DateResultat');
            $table->primary(['nci', 'CodeMat', 'DateResultat']);
            $table->float('NoteControle');
            $table->float('NoteExamen');
            $table->string('resultat');
            $table->timestamps();
            $table->foreign('nci')->references('nci')->on('etudiants')->onDelete('cascade');
            $table->foreign('CodeMat')->references('CodeMat')->on('matieres')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notes');
    }
}

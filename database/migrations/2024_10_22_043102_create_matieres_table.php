<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateMatieresTable extends Migration
{
    public function up()
    {
        Schema::create('matieres', function (Blueprint $table) {
            $table->string('CodeMat')->primary();
            $table->string('CodeSp');
            $table->integer('niveau');
            $table->float('coef');
            $table->integer('credit');
            $table->timestamps();

            $table->foreign('CodeSp')->references('CodeSp')->on('specialites')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('matieres');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anotations', function (Blueprint $table) {
            $table->id();
            $table->string("title",100);
            $table->text("description");

            $table->unsignedBigInteger("user_id"); //id del secretario remitente
            $table->unsignedBigInteger("proceding_id");
            $table->unsignedBigInteger("office_id"); //id de la oficina a quien es dirigida

            $table->timestamps();

            //RELACION DE  UNO A MUCHOS DE SECRETARIO CON LA ANOTACION
            $table->foreign('user_id')
            ->references('user_id')
            ->on('secretaries')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            //RELACION DE  UNO A MUCHOS DE EXPEDIENTES CON LA ANOTACION
            $table->foreign('proceding_id')
            ->references('id')
            ->on('procedings')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            //RELACION DE  UNO A MUCHOS DE ANOTACIONES CON LA OFICINAS
            $table->foreign('office_id')
            ->references('id')
            ->on('offices')
            ->onDelete('cascade')
            ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anotations');
    }
}

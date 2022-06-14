<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->string('ip_origin');
            $table->string('navigator_origin');
            $table->string('os_origin');
            $table->string('office_remitent',100)->nullable();
            $table->string('remitent',100);
            $table->string('office_destiny',100);
            $table->string('destiny',100);
            $table->string('status',50);
            $table->enum('transaction_type',["envio","derivacion","subsanacion","rechazo","archivamiento","notificacion final","subsanando","eliminacion","desarchivamiento"]);

            $table->unsignedBigInteger('proceding_id');
            $table->timestamps();


            //RELACION DE  UNO A MUCHOS DE  EXP CON INCIDENTE
            $table->foreign('proceding_id')
            ->references('id')
            ->on('procedings')
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
        Schema::dropIfExists('incidents');
    }
}

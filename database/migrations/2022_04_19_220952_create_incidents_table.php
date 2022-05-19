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
            $table->string('office_remitent',100);
            $table->string('remitent',100);
            $table->string('office_destiny',100);
            $table->string('destiny',100);
            $table->string('status',50);
            $table->string('ip_origin',50);
            $table->string('transaction_type',100);

            $table->unsignedBigInteger('proceding_id');

            $table->timestamps();


            //RELACION DE  UNO A MUCHOS DE  EXP CON INICIDENTE
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

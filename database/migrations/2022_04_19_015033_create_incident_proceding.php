<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentProceding extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_proceding', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('proceding_id');
            $table->unsignedBigInteger('incident_id');

            $table->timestamps();

            $table->foreign('proceding_id')
            ->references('id')
            ->on('procedings')
            ->onDelete('cascade')
            ->onDelete('cascade');

            $table->foreign('incident_id')
            ->references('id')
            ->on('incidents')
            ->onDelete('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incident_proceding');
    }
}

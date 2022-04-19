<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedings', function (Blueprint $table) {
            $table->id();
            $table->string("code",10)->unique();
            $table->string("title",100);
            $table->text("content");
            $table->string("n_foly",5);
            $table->string("reference",50);

            $table->enum('status',[1,2,3,4,5]);

            /*
            1 = enviado
            2 = derivado
            3 = por subsanar
            4 = archivado
            5 = rechazado
            */


            $table->unsignedBigInteger('office_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('type_proceding_id');

            $table->timestamps();

            $table->foreign('type_proceding_id')
            ->references('id')
            ->on('type_procedings')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('office_id')
            ->references('id')
            ->on('offices')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('user_id')
            ->references('user_id')
            ->on('aplicants')
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
        Schema::dropIfExists('procedings');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string("title",100);
            $table->text("content");


            $table->enum('read_status',[0,1]);

            /*
            0 = no leido
            1 = leído
            */


            $table->unsignedBigInteger('proceding_id');
            $table->unsignedBigInteger('user_id');

            $table->timestamps();

            $table->foreign('proceding_id')
            ->references('id')
            ->on('procedings')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('user_id')
            ->references('user_id')
            ->on('secretaries')
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
        Schema::dropIfExists('answers');
    }
}

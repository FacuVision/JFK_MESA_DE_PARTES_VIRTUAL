<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Quiz extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function(Blueprint $table){
            $table->id();
            $table->enum('usa1',[1,2,3,4,5]);
            $table->enum('usa2',[1,2,3,4,5]);
            $table->enum('fun1',[1,2,3,4,5]);
            $table->enum('fun2',[1,2,3,4,5]);
            $table->enum('acc1',[1,2,3,4,5]);
            $table->enum('acc2',[1,2,3,4,5]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
}

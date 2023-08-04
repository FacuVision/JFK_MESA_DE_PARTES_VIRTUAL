<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('lastname',100);
            $table->date('date_nac');
            $table->enum('gender', ['m','f']);
            $table->string('address');
            $table->string('phone',9);
            $table->string('document_number', 15)->unique();

            //$table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('type_document_id');

                        //RELACION DE  UNO A UNO DE  PERFIL CON USER
                        $table->foreign('user_id')
                        ->references('id')
                        ->on('users')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');

                        //RELACION DE  UNO A MUCHOS DE  PERFIL CON DISTRITO
                        // $table->foreign('district_id')
                        // ->references('id')
                        // ->on('districts')
                        // ->onDelete('cascade')
                        // ->onUpdate('cascade');

                        //RELACION DE  UNO A UNO DE  PERFIL CON TYPE_DOCUMENTS
                        $table->foreign('type_document_id')
                        ->references('id')
                        ->on('type_documents')
                        ->onUpdate('cascade');

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
        Schema::dropIfExists('profiles');
    }
}

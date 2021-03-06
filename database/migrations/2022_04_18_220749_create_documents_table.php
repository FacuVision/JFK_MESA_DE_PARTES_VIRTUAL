<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->unsignedBigInteger('documentable_id');
            $table->string('documentable_type');
            $table->string('url');
            $table->enum('type',[0,1]);

            /*
             * 0 = principal (envio principal)
             * 1 = file (envio anexo)
             */
            $table->timestamps();

            $table->primary(['documentable_id','documentable_type','type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}

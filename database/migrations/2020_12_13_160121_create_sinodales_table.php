<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSinodalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinodales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_profesor');
            $table->integer('id_solicitud');
            $table->integer('id_estatus');
            $table->string('comentario');
            $table->integer('id_tipo');
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
        Schema::dropIfExists('sinodales');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatProyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_proyecto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('usuario_envio');
            $table->text('mensaje');
            $table->integer('id_solicitud');
            $table->integer('id_revisor');
            $table->string('receptor');
            $table->dateTime('fecha');
            $table->integer('estatus');
            $table->string('referencia')->nullable();
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
        Schema::dropIfExists('chat_proyecto');
    }
}

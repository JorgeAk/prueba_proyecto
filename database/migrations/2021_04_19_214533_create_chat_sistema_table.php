<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatSistemaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_sistema', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('usuario_envio');
            $table->string('correo');
            $table->string('asunto');
            $table->text('mensaje');
            $table->string('receptor');
            $table->dateTime('fecha');
            $table->integer('estatus');
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
        Schema::dropIfExists('chat_sistema');
    }
}

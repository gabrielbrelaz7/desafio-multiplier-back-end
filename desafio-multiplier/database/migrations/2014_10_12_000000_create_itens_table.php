<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cardapio_id');
            $table->foreign('cardapio_id')
            ->references('id')
            ->on('cardapios')
            ->onDelete('cascade');
            $table->string('produto');
            $table->string('descricao');
            $table->float('preco');
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
        Schema::dropIfExists('itens');
    }
}

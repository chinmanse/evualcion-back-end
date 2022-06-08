<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();

            $table->string("nombre", 190);
            $table->string("descripcion", 255);
            $table->string("ruta", 255);
            $table->decimal("coste", 10, 2);
            $table->integer("stock");
            $table->integer("estado")->comments("1. activo, 2. Inactivo o eliminado");

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
        Schema::dropIfExists('productos');
    }
}

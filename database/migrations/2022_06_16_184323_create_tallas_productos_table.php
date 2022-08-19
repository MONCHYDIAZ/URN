<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTallasProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tallas_productos', function (Blueprint $table) {
            $table->integer('talla_id');
            $table->integer('producto_id')->index('producto_fk_idx');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('user_creator')->nullable()->index('user_creator_fk_idx');

            $table->primary(['talla_id', 'producto_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tallas_productos');
    }
}

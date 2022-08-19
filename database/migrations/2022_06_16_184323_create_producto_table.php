<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('uuid', 36)->nullable();
            $table->string('nombre')->nullable();
            $table->string('color')->nullable();
            $table->bigInteger('precio')->nullable();
            $table->text('descripcion')->nullable();
            $table->integer('id_categoria')->nullable()->index('producto_categoria_idx');
            $table->boolean('status')->nullable()->default(true);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('user_creator')->index('producto_user_creator_fk_idx');
            $table->unsignedBigInteger('user_last_update')->nullable()->index('producto_user_last_update_fk_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto');
    }
}

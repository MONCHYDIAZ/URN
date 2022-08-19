<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('producto', function (Blueprint $table) {
            $table->foreign(['id_categoria'], 'producto_talla_fk')->references(['id'])->on('talla')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_last_update'], 'producto_user_last_update_fk')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_categoria'], 'producto_categoria_fk')->references(['id'])->on('categoria')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_creator'], 'producto_user_creator_fk')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('producto', function (Blueprint $table) {
            $table->dropForeign('producto_talla_fk');
            $table->dropForeign('producto_user_last_update_fk');
            $table->dropForeign('producto_categoria_fk');
            $table->dropForeign('producto_user_creator_fk');
        });
    }
}

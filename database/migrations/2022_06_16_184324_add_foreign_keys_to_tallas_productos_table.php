<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTallasProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tallas_productos', function (Blueprint $table) {
            $table->foreign(['talla_id'], 'talla_fk')->references(['id'])->on('talla')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['producto_id'], 'producto_fk')->references(['id'])->on('producto')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_creator'], 'user_creator_fk')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tallas_productos', function (Blueprint $table) {
            $table->dropForeign('talla_fk');
            $table->dropForeign('producto_fk');
            $table->dropForeign('user_creator_fk');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDetalleFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detalle_factura', function (Blueprint $table) {
            $table->foreign(['factura_id'], 'fk_detalle_factura')->references(['id'])->on('factura')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_last_update'], 'fk_user_last_update')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['producto_id'], 'fk_detalla_factura_producto')->references(['id'])->on('producto')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_creator'], 'fk_detalle_factura_user_creator')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalle_factura', function (Blueprint $table) {
            $table->dropForeign('fk_detalle_factura');
            $table->dropForeign('fk_user_last_update');
            $table->dropForeign('fk_detalla_factura_producto');
            $table->dropForeign('fk_detalle_factura_user_creator');
        });
    }
}

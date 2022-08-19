<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_factura', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('uuid', 45)->nullable()->index('uuid_index');
            $table->integer('factura_id')->index('fk_detalle_factura_idx');
            $table->integer('producto_id')->index('fk_detalla_factura_producto_idx');
            $table->integer('cantidad')->nullable();
            $table->integer('iva')->nullable();
            $table->integer('total')->nullable();
            $table->boolean('status')->nullable()->default(true);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('user_creator')->index('fk_detalle_factura_user_creator_idx');
            $table->unsignedBigInteger('user_last_update')->nullable()->index('fk_user_last_update_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_factura');
    }
}

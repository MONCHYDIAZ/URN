<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('uuid', 45)->nullable()->index('uuid_index');
            $table->unsignedBigInteger('cliente_id')->index('fk_client_factura_idx');
            $table->integer('total')->nullable();
            $table->integer('iva')->nullable();
            $table->boolean('status')->nullable()->default(true);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('user_creator')->nullable()->index('fk_user_creator_factura_idx');
            $table->unsignedBigInteger('user_last_update')->nullable()->index('fk_user_last_update_factura_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factura');
    }
}

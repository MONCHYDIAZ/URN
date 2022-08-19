<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('factura', function (Blueprint $table) {
            $table->foreign(['user_creator'], 'fk_user_creator_factura')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['cliente_id'], 'fk_client_factura')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_last_update'], 'fk_user_last_update_factura')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('factura', function (Blueprint $table) {
            $table->dropForeign('fk_user_creator_factura');
            $table->dropForeign('fk_client_factura');
            $table->dropForeign('fk_user_last_update_factura');
        });
    }
}

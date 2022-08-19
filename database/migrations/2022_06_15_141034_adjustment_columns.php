<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipo_documento', function (Blueprint $table) {
            $table->bigInteger('user_creator')->unsigned()->change();
            $table->bigInteger('user_last_update')->unsigned()->change();
            $table->foreign('user_creator')->references('id')->on('users');
            $table->foreign('user_last_update')->references('id')->on('users');
        });

        Schema::table('rol', function (Blueprint $table) {
            $table->bigInteger('user_creator')->unsigned()->change();
            $table->bigInteger('user_last_update')->unsigned()->change();
            $table->foreign('user_creator')->references('id')->on('users');
            $table->foreign('user_last_update')->references('id')->on('users');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('user_creator')->unsigned()->change();
            $table->bigInteger('user_last_update')->unsigned()->change();
            $table->foreign('user_creator')->references('id')->on('users');
            $table->foreign('user_last_update')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

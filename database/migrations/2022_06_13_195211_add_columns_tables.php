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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('user_creator')->after('updated_at');
            $table->integer('user_last_update')->after('user_creator')->nullable();
        });

        Schema::table('rol', function (Blueprint $table) {
            $table->integer('user_creator')->after('updated_at');
            $table->integer('user_last_update')->after('user_creator')->nullable();
        });

        Schema::table('tipo_documento', function (Blueprint $table) {
            $table->integer('user_creator')->after('updated_at');
            $table->integer('user_last_update')->after('user_creator')->nullable();
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

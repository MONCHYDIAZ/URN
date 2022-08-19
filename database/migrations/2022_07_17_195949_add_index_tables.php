<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * extends
 */
return new class extends Migration
{
    const TABLES = ['users', 'categoria', 'producto', 'rol', 'talla', 'tipo_documento'];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (self::TABLES as $key => $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->index('uuid');
            });
        }
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

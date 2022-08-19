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
            $table->bigInteger('user_creator')->after('updated_at')->nullable()->unsigned()->change();
        });

        Schema::table('rol', function (Blueprint $table) {
            $table->bigInteger('user_creator')->after('updated_at')->nullable()->unsigned()->change();
        });

        Schema::table('tipo_documento', function (Blueprint $table) {
            $table->bigInteger('user_creator')->after('updated_at')->nullable()->unsigned()->change();
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

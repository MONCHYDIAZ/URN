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
            $table->integer('tipo_documento_id')->after('rol_id');
            $table->string('documento')->after('tipo_documento_id');
            $table->string('telefono')->after('documento');
            $table->string('direccion')->after('documento');
            $table->boolean('status')->nullable()->default(true)->after('remember_token');
            $table->foreign(['tipo_documento_id'], 'tipo_documento_users_fk')->references(['id'])->on('tipo_documento')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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

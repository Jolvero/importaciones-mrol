<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmbarquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('estado_embarques', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps('');
        });

        Schema::create('documentacion_embarques', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('slug');
        });

        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('cliente');
            $table->text('rfc')->nullable();
            $table->text('direccion')->nullable();
            $table->timestamps();
        });

        Schema::create('tipoImportación', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
        });


        Schema::create('meses', function(Blueprint $table)
        {
            $table->id();
            $table->string('mes');
            $table->timestamps();

        });

        Schema::create('despachos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('embarques', function (Blueprint $table) {
            $table->id();
            $table->integer('cliente_id');
            $table->foreignId('tipo_id')->references('id')->on('tipoImportación');
            $table->foreignId('mes_id')->references('id')->on('meses');
            $table->string('referencia');
            $table->date('prealertado');
            $table->foreignId('documentacion_id')->references('id')->on('documentacion_embarques')->comment('el estatus de documentación del embarque');
            $table->date('documentacion')->nullable();
            $table->uuid('file_id');
            $table->foreignId('estado_id')->references('id')->on('estado_embarques')->comment('el estatus del embarque');
            $table->string('user');
            $table->date('arribo')->nullable();
            $table->date('revalidación')->nullable();
            $table->date('previo')->nullable();
            $table->date('pedimento')->nullable();
            $table->date('despacho')->nullable();
            $table->foreignId('despacho_id')->nullable()->references('id')->on('despachos');
            $table->date('pago_anticipo')->nullable();
            $table->date('cuenta_gastos')->nullable();
            $table->uuid('uuid_cta_gastos');
            $table->uuid('uuid');
            $table->uuid('uuid_proforma')->nullable();
            $table->uuid('uuid_kpi')->nullable();
            $table->text('observaciones')->nullable();
            $table->text('observaciones_pedimento')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('embarques');
        Schema::dropIfExists('estado_embarques');
        Schema::dropIfExists('documentacion_embarques');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movimientos_medicamentos', function (Blueprint $table) {

            $table->id();
            $table->unsignedInteger('id_medicamento');
            $table->char('tipo_movimiento', 1);
            $table->integer('cantidad');
            $table->integer('stock_anterior');
            $table->integer('stock_actual');
            $table->string('observacion')->nullable();
            $table->timestamps();
            $table->foreign('id_medicamento')
                ->references('id')
                ->on('medicamentos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimiento_medicamentos');
    }
};

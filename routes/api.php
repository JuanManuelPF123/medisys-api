<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MedicamentoController;
use App\Http\Controllers\Api\MovimientoMedicamentoController;

Route::prefix('v1')->group(function () {

    Route::get('/medicamentos', [MedicamentoController::class, 'index']);

    Route::get('/medicamentos/{id}', [MedicamentoController::class, 'show']);

    Route::post('/medicamentos', [MedicamentoController::class, 'store']);

    Route::put('/medicamentos/{id}', [MedicamentoController::class, 'update']);

    Route::delete('/medicamentos/{id}', [MedicamentoController::class, 'destroy']);

    Route::get('/movimientos', [MovimientoMedicamentoController::class, 'index']);

    Route::post('/movimientos', [MovimientoMedicamentoController::class, 'store']);

    Route::get('/movimientos/{id}', [MovimientoMedicamentoController::class, 'show']);
});

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medicamento;
use App\Models\MovimientoMedicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Responses\ApiResponse;

class MovimientoMedicamentoController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Listado de movimientos.',
            'data' => MovimientoMedicamento::with('medicamento')->get()
        ], 200);
    }

    public function show($id)
    {
        return response()->json([
            'success' => true,
            'message' => 'Movimiento encontrado.',
            'data' => MovimientoMedicamento::with('medicamento')->findOrFail($id)
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_medicamento' => 'required|exists:medicamentos,id',
            'tipo_movimiento' => 'required|in:E,S',
            'cantidad' => 'required|integer|min:1',
            'observacion' => 'nullable|string'
        ]);

        return DB::transaction(function () use ($request) {

            $medicamento = Medicamento::findOrFail($request->id_medicamento);
            $stockAnterior = $medicamento->stock;

            if ($request->tipo_movimiento == 'E') {
                $stockActual = $stockAnterior + $request->cantidad;
            } else {

                if ($stockAnterior < $request->cantidad) {

                    return response()->json([
                        'success' => false,
                        'message' => 'Stock insuficiente.'
                    ], 422);
                }

                $stockActual = $stockAnterior - $request->cantidad;
            }

            $medicamento->update([
                'stock' => $stockActual
            ]);

            $movimiento = MovimientoMedicamento::create([

                'id_medicamento' => $request->id_medicamento,
                'tipo_movimiento' => $request->tipo_movimiento,
                'cantidad' => $request->cantidad,
                'stock_anterior' => $stockAnterior,
                'stock_actual' => $stockActual,
                'observacion' => $request->observacion
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Movimiento registrado correctamente.',
                'data' => $movimiento
            ], 201);

        });
    }
}

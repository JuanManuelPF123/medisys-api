<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medicamento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    // Listar todos
    public function index()
    {
        $medicamentos = Medicamento::all();

        return response()->json([
            'success' => true,
            'message' => 'Listado de medicamentos.',
            'data' => $medicamentos
        ], 200);
    }



    // Registrar
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:medicamentos',
            'nombre' => 'required',
            'stock'  => 'required|integer',
            'precio' => 'required|numeric'
        ]);

        $medicamento = Medicamento::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Medicamento registrado correctamente.',
            'data' => $medicamento
        ], 201);
    }

    // Mostrar uno
    public function show($id)
    {
        $medicamento = Medicamento::findOrFail($id);
        return response()->json([
            'success' => true,
            'message' => 'Medicamento encontrado.',
            'data' => $medicamento
        ], 200);
    }


    // Actualizar
    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo' => 'required',
            'nombre' => 'required',
            'stock'  => 'required|integer',
            'precio' => 'required|numeric'
        ]);

        $medicamento = Medicamento::findOrFail($id);
        $medicamento->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Medicamento actualizado correctamente.',
            'data' => $medicamento
        ], 200);
    }


    // Eliminar
    public function destroy($id)
    {
        $medicamento = Medicamento::findOrFail($id);
        $medicamento->delete();
        return response()->json([
            'success' => true,
            'message' => 'Medicamento eliminado correctamente.',
            'data' => null
        ], 200);
    }

}

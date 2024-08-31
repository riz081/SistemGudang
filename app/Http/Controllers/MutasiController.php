<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    public function index()
    {
        $mutasis = Mutasi::all();
        return response()->json($mutasis);
    }
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis_mutasi' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'barang_id' => 'required|exists:barangs,id',
        ]);

        $mutasi = Mutasi::create($request->all());

        return response()->json($mutasi, 201);
    }

    public function show($id)
    {
        $mutasi = Mutasi::find($id);

        if (!$mutasi) {
            return response()->json(['message' => 'Mutasi not found'], 404);
        }

        return response()->json($mutasi);
    }

    public function update(Request $request, $id)
    {
        $mutasi = Mutasi::find($id);

        if (!$mutasi) {
            return response()->json(['message' => 'Mutasi not found'], 404);
        }

        $mutasi->update($request->all());

        return response()->json($mutasi);
    }

    public function destroy($id)
    {
        $mutasi = Mutasi::find($id);

        if (!$mutasi) {
            return response()->json(['message' => 'Mutasi not found'], 404);
        }

        $mutasi->delete();

        return response()->json(['message' => 'Mutasi deleted successfully']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Mutasi;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return response()->json($barangs);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode' => 'required|string|unique:barangs',
            'kategori' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
        ]);

        $barang = Barang::create($request->all());

        return response()->json($barang, 201);
    }

    public function show($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        return response()->json($barang);
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        $barang->update($request->all());

        return response()->json($barang);
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        $barang->delete();

        return response()->json(['message' => 'Barang deleted successfully']);
    }

    public function history($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        $history = Mutasi::where('barang_id', $id)->get();

        return response()->json($history);
    }
}

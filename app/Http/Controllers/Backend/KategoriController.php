<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::orderBy('nama')->get();

        return view('backend.penyakit.kategori.index', [
            'kategori' => $kategori
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255'
        ]);

        Kategori::create([
            'nama' => $request->nama
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255'
        ]);

        $kategori = Kategori::find($id);

        $kategori->update([
            'nama' => $request->nama
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        $kategori->delete();

        return redirect()->back();
    }
}

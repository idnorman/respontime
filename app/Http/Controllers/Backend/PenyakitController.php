<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    public function index()
    {
        $penyakit = Penyakit::with('kategori')->orderBy('nama')->get();
        $kategori = Kategori::orderBy('nama')->get();

        return view('backend.penyakit.daftar-penyakit.index', [
            'penyakit' => $penyakit,
            'kategori' => $kategori,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'nama' => 'required|string|max:255',
            'waktu_minimal' => 'integer|nullable',
            'waktu_maksimal' => 'integer|nullable'
        ]);

        $data = $request->all();

        Penyakit::create([
            'kategori_id' => $data['kategori_id'],
            'nama' => $data['nama'],
            'waktu_minimal' => $data['waktu_minimal'],
            'waktu_maksimal' => $data['waktu_maksimal'],
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required',
            'nama' => 'required|string|max:255',
            'waktu_minimal' => 'integer|nullable',
            'waktu_maksimal' => 'integer|nullable'
        ]);

        $data = $request->all();


        $penyakit = Penyakit::find($id);

        $penyakit->update([
            'kategori_id' => $data['kategori_id'],
            'nama' => $data['nama'],
            'waktu_minimal' => $data['waktu_minimal'],
            'waktu_maksimal' => $data['waktu_maksimal'],
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $penyakit = Penyakit::find($id);

        $penyakit->delete();

        return redirect()->back();
    }
}

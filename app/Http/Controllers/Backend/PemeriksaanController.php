<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use App\Models\Penyakit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PemeriksaanController extends Controller
{
    public function index()
    {
        $pemeriksaan = Pemeriksaan::with(['pasien', 'penyakit'])->orderBy('created_at', 'desc')->get();
        $penyakits = Penyakit::orderBy('nama', 'asc')->get();

        return view('backend.pemeriksaan.index', [
            'pemeriksaan' => $pemeriksaan,
            'penyakits' => $penyakits
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $pasien = Pasien::where('nik', $data['nik'])->first();

        if (!$pasien) {
            Pasien::create([
                'nama' => $data['pasien'],
                'nik' => $data['nik']
            ]);
        }

        $pasien_baru = Pasien::where('nik', $data['nik'])->first();

        Pemeriksaan::create([
            'penyakit_id' => $data['penyakit'],
            'pasien_id' => $pasien_baru->id,
        ]);

        return redirect()->back()->with(['reload' => 'true']);
    }

    public function update($id)
    {
        $data = Pemeriksaan::findOrFail($id);
        $time = Carbon::now()->toDateTimeString();

        $data->update([
            'status' => 'selesai',
            'waktu_selesai' => $time
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $data = Pemeriksaan::findOrFail($id);

        $data->delete();

        return redirect()->back();
    }
}

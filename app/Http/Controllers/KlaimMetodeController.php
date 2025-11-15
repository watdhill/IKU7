<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fakultas;
use App\Models\Departemen;
use App\Models\Semester;
use App\Models\MataKuliah;
use App\Models\Metode;
use App\Models\KlaimMetode;
use App\Models\KomponenPenilaian;
use App\Models\DokumenMetode;

class KlaimMetodeController extends Controller
{
    public function create()
    {
        $fakultas = Fakultas::all();
        $semester = Semester::all();
        $metode = Metode::all();
        return view('dosen.klaim_metode.create', compact('fakultas','semester','metode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fakultas_id' => 'required',
            'departemen_id' => 'required',
            'semester_id' => 'required',
            'mata_kuliah_id' => 'required',
            'metode_id' => 'required',
            'tahun_ajaran' => 'required',
            'komponen.*.nama' => 'required',
            'komponen.*.persentase' => 'required|numeric',
            'dokumen.*' => 'file|mimes:pdf,doc,docx'
        ]);

        // Validasi total persentase 100%
        $total = array_sum($request->komponen['persentase']);
        if($total != 100){
            return back()->with('error', 'Total persentase harus 100%')->withInput();
        }

        // Simpan klaim metode
        $klaim = KlaimMetode::create([
            'dosen_id' => auth()->user()->id,
            'id_mk' => $request->mata_kuliah_id,
            'id_metode' => $request->metode_id,
            'id_semester' => $request->semester_id,
            'tahun_ajaran' => $request->tahun_ajaran
        ]);

        // Simpan komponen
        foreach($request->komponen['nama'] as $i => $nama){
            KomponenPenilaian::create([
                'id_mk' => $request->mata_kuliah_id,
                'id_metode' => $request->metode_id,
                'nama_komponen' => $nama,
                'persentase' => $request->komponen['persentase'][$i]
            ]);
        }

        // Simpan dokumen
        if($request->hasFile('dokumen')){
            foreach($request->file('dokumen') as $file){
                $filename = time().'_'.$file->getClientOriginalName();
                $file->storeAs('dokumen_metode', $filename, 'public');

                DokumenMetode::create([
                    'klaim_metode_id' => $klaim->id,
                    'nama_dokumen' => $file->getClientOriginalName(),
                    'file_path' => 'dokumen_metode/'.$filename
                ]);
            }
        }

        return redirect()->route('dosen.dashboard')->with('success','Klaim metode berhasil disimpan');
    }

    // AJAX untuk dropdown
    public function getDepartemen($fakultas_id)
    {
        $departemen = Departemen::where('id_fakultas',$fakultas_id)->get();
        return response()->json($departemen);
    }

    public function getMataKuliah($departemen_id, $semester_id)
    {
        $mk = MataKuliah::where('id_departemen',$departemen_id)
                ->where('id_semester',$semester_id)
                ->get();
        return response()->json($mk);
    }
}

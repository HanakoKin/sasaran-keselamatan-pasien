<?php

namespace App\Http\Controllers;

use App\Models\Lapin;
use App\Models\Lapkpc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LapkpcController extends Controller
{

    public function lapkpc(){

        $title = 'Laporan KPC';

        $lapkpcs = Lapkpc::orderBy('created_at', 'desc')->get();

        return view('pages.lapkpc.lapkpc', compact('lapkpcs', 'title'));

    }

    public function addLapkpcPage(){

        $title = 'Laporan KPC Form';

        return view('pages.lapkpc.addLapkpc', compact('title'));

    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'pembuat_laporan' => 'required|string',
            'status' => 'required|string',
            'kpc' => 'required|string',
            'tanggal_ditemukan' => 'required|date',
            'jam_ditemukan' => 'required|date_format:H:i',
            'pelapor_insiden' => 'required|string',
            'tempat_insiden' => 'required|string',
            'unit_insiden' => 'required|string',
            'tindakan_cepat' => 'required|string',
            'tindakan_insiden' => 'required|string',
            'kejadian_insiden' => 'required|string'
        ]);

        Lapkpc::create($validatedData);

        return redirect()->to('/lapkpc')->with('success', 'LapKPC added successfully!');

    }

    public function edit($id){

        $title = 'Edit data KPC';

        $lapkpc = Lapkpc::findOrFail($id);

        $fixed_kejadian_insiden = str_replace('Ya, terjadi pada ', '', $lapkpc->kejadian_insiden);

        return view('pages.lapkpc.editLapkpc', compact('lapkpc', 'fixed_kejadian_insiden', 'title'));

    }

    public function update(Request $request, $id){

        // dd($request);

        $jam_ditemukan = substr($request->jam_ditemukan, 0, 5);
        $jam_ditemukan = substr($request->jam_ditemukan, 0, 5);

        $request->merge(['jam_ditemukan' => $jam_ditemukan]);
        $request->merge(['jam_ditemukan' => $jam_ditemukan]);

        // dd($request);

        $validatedData = $request->validate([
            'kpc' => 'required|string',
            'tanggal_ditemukan' => 'required|date',
            'jam_ditemukan' => 'required|date_format:H:i',
            'pelapor_insiden' => 'required|string',
            'tempat_insiden' => 'required|string',
            'unit_insiden' => 'required|string',
            'tindakan_cepat' => 'required|string',
            'tindakan_insiden' => 'required|string',
            'kejadian_insiden' => 'required|string'
        ]);

        Lapkpc::where('id', $id)->update($validatedData);

        return redirect()->to('/lapkpc')->with('success', 'LapKPC updated successfully!');

    }

    public function delete($id){

        $lapkpc = Lapkpc::where('id', '=', $id)->delete();

        return back()->with('success', 'LapKPC deleted successfully!');
    }

    public function verifikasi($id){

        $title = "Verifikasi Laporan Insiden";

        $category = "Lapkpc";

        $data = lapkpc::findOrFail($id);

        return view('pages.lapkpc.verifikasiLapkpc', compact('title', 'data', 'category'));
    }

    public function grading(Request $request, $id){

        $apkpc = Lapkpc::findOrFail($id);

        // dd($request);

        $validatedData = $request->validate([
            'status' => 'required|string',
            'penerima_laporan' => 'required|string',
            'tanggal_terima' => 'required|date'
        ]);

        Lapkpc::where('id', $id)->update($validatedData);

        return back()->with('success', 'LAPKPC deleted successfully!');

        // return view('pages.verifikasiLapin', compact('title', 'lapin'));
    }


}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lapin;
use App\Models\Lapkpc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LapkpcController extends Controller
{

    public function lapkpc(){

        $title = 'Laporan KPC';

        $lapkpcs = Lapkpc::orderBy('created_at', 'desc');

        if (!Auth::user()->isAdmin()) {
            $lapkpcs->where('unit_kerja', Auth::user()->unit);
        }

        $lapkpcs = $lapkpcs->get();

        return view('pages.lapkpc.lapkpc', compact('lapkpcs', 'title'));

    }

    public function lapkpcTable(){

        $title = 'Tabel Kondisi Potensial Cedera';

        $lapkpcs = Lapkpc::orderBy('created_at', 'desc')->get();

        if (!Auth::user()->isAdmin()) {
            return redirect('/lapkpc')->with('error', 'UNAUTHORIZED ACTION');
        }

        return view('pages.lapkpc.lapkpcTable', compact('lapkpcs', 'title'));

    }

    public function addLapkpcPage(){

        $title = 'Laporan KPC Form';

        return view('pages.lapkpc.addLapkpc', compact('title'));

    }

    public function store(Request $request){

        $validatedData = $request->validate([

            'unit_kerja' => 'required|string',
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

        $data = Lapkpc::findOrFail($id);
        $kategori = 'lapkpc';

        if ((!Auth::user()->isAdmin()) && (Auth::user()->unit !== $data->unit_kerja)) {
            return redirect('/lapkpc')->with('error', 'UNAUTHORIZED ACTION');
        }

        // Tandai data sedang diedit
        $data->update(['proses_edit' => true]);

        $fixed_kejadian_insiden = str_replace('Ya, terjadi pada ', '', $data->kejadian_insiden);

        return view('pages.lapkpc.editLapkpc', compact('data', 'fixed_kejadian_insiden', 'title', 'kategori'));

    }

    public function update(Request $request, $id){

        // dd($request);

        $jam_ditemukan = substr($request->jam_ditemukan, 0, 5);
        $jam_ditemukan = substr($request->jam_ditemukan, 0, 5);

        $request->merge(['jam_ditemukan' => $jam_ditemukan]);
        $request->merge(['jam_ditemukan' => $jam_ditemukan]);

        // dd($request);

        $validatedData = $request->validate([
            'unit_kerja' => 'required|string',
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
        // Hapus penanda sedang diedit setelah proses edit selesai
        Lapkpc::where('id', $id)->update(['proses_edit' => false]);

        return redirect()->to('/lapkpc')->with('success', 'LapKPC updated successfully!');

    }

    public function delete($id){

        $lapkpc = Lapkpc::findOrFail($id);

        if ((!Auth::user()->isAdmin()) && (Auth::user()->unit !== $lapkpc->unit_kerja)) {
            return redirect('/lapkpc')->with('error', 'UNAUTHORIZED ACTION');
        }

         // Hapus data LAPKPC
         $lapkpc->delete();

         return back()->with('success', 'LAPKPC deleted successfully!');

    }

    public function resetEditStatus($id){

        $lapkpc = Lapkpc::findOrFail($id);

        // Hapus penanda sedang diedit dari database
        $lapkpc->update(['proses_edit' => false]);

        return response()->json(['message' => 'Status edit berhasil diperbarui']);
    }

    public function verifikasi($id){

        $title = "Verifikasi Laporan Insiden";

        $category = "Lapkpc";

        $data = lapkpc::findOrFail($id);

        if ($data->proses_edit) {
            return redirect()->back()->with('error', 'Data sedang dalam proses edit. Verifikasi mungkin perlu ditunda.');
        }

        $data->tanggal_ditemukan = Carbon::parse($data->tanggal_ditemukan)->format('d-m-Y');

        if ($data->tanggal_terima !== null) {
            $data->tanggal_terima = Carbon::parse($data->tanggal_terima)->format('d-m-Y');
        } else {
            $data->tanggal_terima = '';
        }

        $data->jam_ditemukan = substr($data->jam_ditemukan, 0, 5);

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

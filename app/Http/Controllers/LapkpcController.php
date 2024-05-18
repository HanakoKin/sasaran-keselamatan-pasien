<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lapkpc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LapkpcController extends Controller
{

    // LapKPC Page
    public function lapkpc()
    {
        $title = 'Laporan KPCS';

        $lapkpcs = Lapkpc::orderBy('created_at', 'desc');

        if (Auth::user()->role === 'user') {
            $lapkpcs->where('unit_kerja', Auth::user()->unit);
        }

        $lapkpcs = $lapkpcs->get();

        return view('pages.lapkpc.index', compact('lapkpcs', 'title'));

    }

    // LapKPC Table Page
    public function lapkpcTable()
    {

        $title = 'Tabel KPCS';

        $lapkpcs = Lapkpc::orderBy('created_at', 'desc')->get();

        return view('pages.lapkpc.table', compact('lapkpcs', 'title'));

    }

    // Add LapKPC Form Page
    public function addLapkpcPage()
    {
        $title = 'Laporan KPCS Form';
        return view('pages.lapkpc.add', compact('title'));
    }

    // Add new LapKPC Function
    public function store(Request $request)
    {
        $request->merge(['paraf_pelapor' => $request->input('ttd_pelengkap')]);

        $validator = Validator::make($request->all(), [
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
            'kejadian_insiden' => 'required|string',
            'paraf_pelapor' =>  'required|string',
        ]);

        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return back()->with('error', $errors)->withInput();
        }

        $validatedData = $validator->validated();
        Lapkpc::create($validatedData);
        return redirect()->to('/lapkpc')->with('success', 'LapKPC added successfully!');
    }

    // LapKPC edit Form
    public function edit($id)
    {
        $title = 'Edit data KPCS';
        $data = Lapkpc::findOrFail($id);
        $kategori = 'lapkpc';

        if ((Auth::user()->role === 'user') && (Auth::user()->unit !== $data->unit_kerja)) {
            return redirect('/lapkpc')->with('error', 'UNAUTHORIZED ACTION');
        }

        $data->update(['proses_edit' => true]);
        $fixed_kejadian_insiden = str_replace('Ya, terjadi pada ', '', $data->kejadian_insiden);
        return view('pages.lapkpc.edit', compact('data', 'fixed_kejadian_insiden', 'title', 'kategori'));
    }

    // Edit existing LapKPC Function
    public function update(Request $request, $id)
    {
        $jam_ditemukan = substr($request->jam_ditemukan, 0, 5);
        $jam_ditemukan = substr($request->jam_ditemukan, 0, 5);

        $request->merge(['jam_ditemukan' => $jam_ditemukan]);
        $request->merge(['jam_ditemukan' => $jam_ditemukan]);

        $validator = Validator::make($request->all(), [
            'unit_kerja' => 'required|string',
            'kpc' => 'required|string',
            'tanggal_ditemukan' => 'required|date',
            'jam_ditemukan' => 'required|date_format:H:i',
            'pelapor_insiden' => 'required|string',
            'tempat_insiden' => 'required|string',
            'unit_insiden' => 'required|string',
            'tindakan_cepat' => 'required|string',
            'tindakan_insiden' => 'required|string',
            'kejadian_insiden' => 'required|string',
            'paraf_pelapor' => 'required|string'
        ]);

        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return back()->with('error', $errors)->withInput();
        }

        $validatedData = $validator->validated();

        Lapkpc::where('id', $id)->update($validatedData);
        // Hapus penanda sedang diedit setelah proses edit selesai
        Lapkpc::where('id', $id)->update(['proses_edit' => false]);

        return redirect()->to('/lapkpc')->with('success', 'LapKPC updated successfully!');
    }

    // Delete LapKPC Function
    public function delete($id)
    {
        $lapkpc = Lapkpc::findOrFail($id);

        if ((Auth::user()->role === 'user') && (Auth::user()->unit !== $lapkpc->unit_kerja)) {
            return redirect('/lapkpc')->with('error', 'UNAUTHORIZED ACTION');
        }

         // Hapus data LAPKPC
         $lapkpc->delete();

         return back()->with('success', 'LAPKPC deleted successfully!');
    }

    // Reset Edit Status Function
    public function resetEditStatus($id)
    {
        $lapkpc = Lapkpc::findOrFail($id);

        $lapkpc->update(['proses_edit' => false]);

        return response()->json(['message' => 'Status edit berhasil diperbarui']);
    }

    // LapKPC Verification Page
    public function verifikasi($id)
    {
        $title = "Verifikasi KPCS";
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
        return view('pages.lapkpc.verification', compact('title', 'data', 'category'));
    }

    // LapKPC Grading Function
    public function grading(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string',
            'penerima_laporan' => 'required|string',
            'tanggal_terima' => 'required|date',
            'paraf_penerima' => 'required|string'
        ]);

        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return back()->with('error', $errors)->withInput();
        }

        $validatedData = $validator->validated();
        Lapkpc::where('id', $id)->update($validatedData);
        return redirect('/lapkpc')->with('success', 'LAPKPC deleted successfully!');
    }

}

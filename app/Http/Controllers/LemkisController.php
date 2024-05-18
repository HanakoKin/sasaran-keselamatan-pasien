<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lemkis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LemkisController extends Controller
{
    // LEMKIS Page
    public function lemkis()
    {
        $title = 'Lembar Investigasi Sederhana';
        $lemkises = Lemkis::orderBy('created_at', 'desc');

        if (Auth::user()->role === 'user') {
            $lemkises->where('unit_kerja', Auth::user()->unit);
        }

        $lemkises = $lemkises->get();
        return view('pages.lemkis.index', compact('lemkises', 'title'));
    }

    // LEMKIS Table Page
    public function lemkisTable()
    {
        $title = 'Laporan Lembar Kerja Investigasi Sederhana';

        $lemkis = Lemkis::orderBy('created_at', 'desc')->get();

        return view('pages.lemkis.table', compact('lemkis', 'title'));
    }

    // LEMKIS add Form Page
    public function addLemkisPage()
    {
        $title = 'Lembar Kerja Investigasi Sederhana';

        return view('pages.lemkis.add', compact('title'));
    }

    // Add new LEMKIS Function
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            /* DATA TAMBAHAN */
            'lapin_id' => 'required',
            'unit_kerja' => 'required',

            /* DATA LEMKIS */
            'penyebab_langsung' => 'required|string',
            'penyebab_awal' => 'required|string',
            'rekom_invest_pendek' => 'nullable|string',
            'penanggung_rekom_pendek' => 'nullable|string',
            'tanggal_rekom_pendek' => 'nullable|date',
            'rekom_invest_menengah' => 'nullable|string',
            'penanggung_rekom_menengah' => 'nullable|string',
            'tanggal_rekom_menengah' => 'nullable|date',
            'rekom_invest_panjang' => 'nullable|string',
            'penanggung_rekom_panjang' => 'nullable|string',
            'tanggal_rekom_panjang' => 'nullable|date',
            'realisasi_invest_pendek' => 'nullable|string',
            'penanggung_realisasi_pendek' => 'nullable|string',
            'tanggal_realisasi_pendek' => 'nullable|date',
            'realisasi_invest_menengah' => 'nullable|string',
            'penanggung_realisasi_menengah' => 'nullable|string',
            'tanggal_realisasi_menengah' => 'nullable|date',
            'realisasi_invest_panjang' => 'nullable|string',
            'penanggung_realisasi_panjang' => 'nullable|string',
            'tanggal_realisasi_panjang' => 'nullable|date',
            'nama_pelengkap' => 'required|string',
            'ttd_pelengkap' => 'required|string',
            'bagian_pelengkap' => 'required|string',
            'tanggal_mulai_invest' => 'required|date',
            'tanggal_dilengkapi' => 'required|date',
            'tanggal_informasi' => 'required|date',
            'direksi' => 'nullable|string',
            'asdir' => 'nullable|string',
            'timkes' => 'nullable|string',
            'personalia' => 'nullable|string',
            'invest_lengkap' => 'required|string',
            'tanggal_pengesahan' => 'required|date',
            'invest_lanjut' => 'required|string',
            'grading_akhir' => 'required|string',
        ]);

        Lemkis::create($validatedData);
        return redirect('/lemkis')->with('success', 'LEMKIS added successfully!');
    }

    // LEMKIS edit Form Page
    public function edit($id)
    {
        $title = 'Edit LEMKIS';
        $data = Lemkis::findOrFail($id);
        $kategori = 'lemkis';

        if ((Auth::user()->role === 'user') && (Auth::user()->unit !== $data->unit_kerja)) {
            return redirect('/lemkis')->with('error', 'UNAUTHORIZED ACTION');
        }

        return view('pages.lemkis.edit', compact('data', 'title', 'kategori'));
    }

    // Edit existing LEMKIS Function
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'penyebab_langsung' => 'required|string',
            'penyebab_awal' => 'required|string',
            'rekom_invest_pendek' => 'nullable|string',
            'penanggung_rekom_pendek' => 'nullable|string',
            'tanggal_rekom_pendek' => 'nullable|date',
            'rekom_invest_menengah' => 'nullable|string',
            'penanggung_rekom_menengah' => 'nullable|string',
            'tanggal_rekom_menengah' => 'nullable|date',
            'rekom_invest_panjang' => 'nullable|string',
            'penanggung_rekom_panjang' => 'nullable|string',
            'tanggal_rekom_panjang' => 'nullable|date',
            'realisasi_invest_pendek' => 'nullable|string',
            'penanggung_realisasi_pendek' => 'nullable|string',
            'tanggal_realisasi_pendek' => 'nullable|date',
            'realisasi_invest_menengah' => 'nullable|string',
            'penanggung_realisasi_menengah' => 'nullable|string',
            'tanggal_realisasi_menengah' => 'nullable|date',
            'realisasi_invest_panjang' => 'nullable|string',
            'penanggung_realisasi_panjang' => 'nullable|string',
            'tanggal_realisasi_panjang' => 'nullable|date',
            'nama_pelengkap' => 'required|string',
            'ttd_pelengkap' => 'required|string',
            'bagian_pelengkap' => 'required|string',
            'tanggal_mulai_invest' => 'required|date',
            'tanggal_dilengkapi' => 'required|date',
            'tanggal_informasi' => 'required|date',
            'direksi' => 'nullable|string',
            'asdir' => 'nullable|string',
            'timkes' => 'nullable|string',
            'personalia' => 'nullable|string',
            'invest_lengkap' => 'required|string',
            'tanggal_pengesahan' => 'required|date',
            'invest_lanjut' => 'required|string',
            'grading_akhir' => 'required|string',
        ]);

        Lemkis::where('id', $id)->update($validatedData);
        return redirect('/lemkis')->with('success', 'LEMKIS updated successfully!');
    }

    // Delete LEMKIS Function
    public function delete($id)
    {
        $lemkis = Lemkis::findOrFail($id);

        if ((Auth::user()->role === 'user') && (Auth::user()->unit !== $lemkis->unit_kerja)) {
            return redirect('/lemkis')->with('error', 'UNAUTHORIZED ACTION');
        }

         $lemkis->delete();
         return back()->with('success', 'LEMKIS deleted successfully!');
    }

    // Check & Print LEMKIS Function
    public function show($id)
    {
        $title = "Cek & Print LEMKIS";
        $data = Lemkis::findOrFail($id);

        if ($data->tanggal_rekom_pendek !== NULL){
            $data->tanggal_rekom_pendek = Carbon::parse($data->tanggal_rekom_pendek)->format('d-m-Y');
        } else if ($data->tanggal_rekom_menengah !== NULL){
            $data->tanggal_rekom_menengah = Carbon::parse($data->tanggal_rekom_menengah)->format('d-m-Y');
        } else if ($data->tanggal_rekom_panjang !== NULL){
            $data->tanggal_rekom_panjang = Carbon::parse($data->tanggal_rekom_panjang)->format('d-m-Y');
        }

        if ($data->tanggal_realisasi_pendek !== NULL){
            $data->tanggal_realisasi_pendek = Carbon::parse($data->tanggal_realisasi_pendek)->format('d-m-Y');
        } else if ($data->tanggal_realisasi_menengah !== NULL){
            $data->tanggal_realisasi_menengah = Carbon::parse($data->tanggal_realisasi_menengah)->format('d-m-Y');
        } else if ($data->tanggal_realisasi_panjang !== NULL){
            $data->tanggal_realisasi_panjang = Carbon::parse($data->tanggal_realisasi_panjang)->format('d-m-Y');
        }

        if ($data->tanggal_mulai_invest !== NULL){
            $data->tanggal_mulai_invest = Carbon::parse($data->tanggal_mulai_invest)->format('d-m-Y');
        }
        if ($data->tanggal_dilengkapi !== NULL){
            $data->tanggal_dilengkapi = Carbon::parse($data->tanggal_dilengkapi)->format('d-m-Y');
        }
        if ($data->tanggal_informasi !== NULL){
            $data->tanggal_informasi = Carbon::parse($data->tanggal_informasi)->format('d-m-Y');
        }
        if ($data->tanggal_pengesahan !== NULL){
            $data->tanggal_pengesahan = Carbon::parse($data->tanggal_pengesahan)->format('d-m-Y');
        }

        $data_catatan = $data->catatan;
        $data_tanggal = $data->tanggal_catatan;
        $data_narasumber = $data->narasumber;

        $fixed_data_catatan = explode('-- ', $data_catatan);

        if(count($fixed_data_catatan) === 1) {
            $fixed_data_catatan = [$data_catatan];
        }

        $fixed_data_tanggal = explode(', ', $data_tanggal);

        if(count($fixed_data_tanggal) === 1) {
            $fixed_data_tanggal = [$data_tanggal];
        }

        $fixed_data_narasumber = explode('-- ', $data_narasumber);

        if(count($fixed_data_narasumber) === 1) {
            $fixed_data_narasumber = [$data_narasumber];
        }

        return view('pages.lemkis.print', compact('title', 'data', 'fixed_data_catatan', 'fixed_data_tanggal', 'fixed_data_narasumber'));
    }

    // Note LEMKIS add Form Page
    public function addNoteForm($id)
    {
        $title = 'Add Note LEMKIS';
        $data = Lemkis::findOrFail($id);

        $data_catatan = $data->catatan;
        $data_tanggal = $data->tanggal_catatan;
        $data_narasumber = $data->narasumber;

        $fixed_data_catatan = explode('-- ', $data_catatan);

        if(count($fixed_data_catatan) === 1) {
            $fixed_data_catatan = [$data_catatan];
        }

        $fixed_data_tanggal = explode(', ', $data_tanggal);

        if(count($fixed_data_tanggal) === 1) {
            $fixed_data_tanggal = [$data_tanggal];
        }

        $fixed_data_narasumber = explode('-- ', $data_catatan);

        if(count($fixed_data_narasumber) === 1) {
            $fixed_data_narasumber = [$data_narasumber];
        }

        return view('pages.lemkis.note.add', compact('data', 'title', 'fixed_data_catatan', 'fixed_data_tanggal', 'fixed_data_narasumber'));
    }

    // LEMKIS's Note Table Page
    public function noteTable($id)
    {
        $title = "LEMKIS's Note Table";
        $data = Lemkis::findOrFail($id);

        $data_catatan = $data->catatan;
        $data_tanggal = $data->tanggal_catatan;
        $data_narasumber = $data->narasumber;

        $fixed_data_catatan = explode('-- ', $data_catatan);

        if(count($fixed_data_catatan) === 1) {
            $fixed_data_catatan = [$data_catatan];
        }

        $fixed_data_tanggal = explode(', ', $data_tanggal);

        if(count($fixed_data_tanggal) === 1) {
            $fixed_data_tanggal = [$data_tanggal];
        }

        $fixed_data_narasumber = explode('-- ', $data_narasumber);

        if(count($fixed_data_narasumber) === 1) {
            $fixed_data_narasumber = [$data_narasumber];
        }

        return view('pages.lemkis.note.table', compact('data', 'title', 'fixed_data_catatan', 'fixed_data_tanggal', 'fixed_data_narasumber'));
    }

    // Add new LEMKIS's Note Function
    public function saveNote(Request $request, $id)
    {
        $catatanString = implode('-- ', $request->input('catatan', []));
        $tanggalString = implode(', ', $request->input('tanggal_catatan', []));
        $narasumberString = implode('-- ', $request->input('narasumber', []));

        $request->merge(['catatan' => $catatanString]);
        $request->merge(['tanggal_catatan' => $tanggalString]);
        $request->merge(['narasumber' => $narasumberString]);

        $validatedData = $request->validate([
            'catatan' => 'nullable|string',
            'tanggal_catatan' => 'nullable|string',
            'narasumber' => 'nullable|string',
        ]);

        Lemkis::where('id', $id)->update($validatedData);
        return redirect('/lemkis')->with('success', 'LEMKIS note added successfully!');
    }

}

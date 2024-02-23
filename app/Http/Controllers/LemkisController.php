<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lemkis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LemkisController extends Controller
{
    public function lemkis(){

        $title = 'Laporan Insiden';

        $lemkises = Lemkis::orderBy('created_at', 'desc')->get();

        return view('pages.lemkis.lemkis', compact('lemkises', 'title'));

    }

    public function lemkisTable(){

        $title = 'Laporan Lembar Kerja Investigasi Sederhana';

        $lemkis = Lemkis::orderBy('created_at', 'desc')->get();

        return view('pages.lemkis.lemkisTable', compact('lemkis', 'title'));

    }

    public function addLemkisPage(){

        $title = 'Lembar Kerja Investigasi Sederhana';

        return view('pages.lemkis.addLemkis', compact('title'));

    }

    public function edit($id){

        $title = 'Edit LEMKIS';

        $lemkis = Lemkis::findOrFail($id);

        return view('pages.lemkis.editLemkis', compact('lemkis', 'title'));

    }

    public function store(Request $request){

        // dd($request);

        $validatedData = $request->validate([

            /* DATA TAMBAHAN */
            'lapin_id' => 'required',

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

    public function update(Request $request, $id){
        // dd($request);

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

    public function delete($id){

        $lemkis = Lemkis::where('id', '=', $id)->delete();

        return back()->with('success', 'LEMKIS deleted successfully!');
    }

    public function show($id){

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

        // Pemisahan data Catatan
        $fixed_data_catatan = explode('-- ', $data_catatan);

        if(count($fixed_data_catatan) === 1) {
            $fixed_data_catatan = [$data_catatan];
        }

        // Pemisahan data Tanggal Catatan
        $fixed_data_tanggal = explode(', ', $data_tanggal);

        if(count($fixed_data_tanggal) === 1) {
            $fixed_data_tanggal = [$data_tanggal];
        }


        return view('pages.lemkis.showLemkis', compact('title', 'data', 'fixed_data_catatan', 'fixed_data_tanggal'));
    }

    public function addNoteForm($id){

        $title = 'Add Note LEMKIS';

        $data = Lemkis::findOrFail($id);

        $data_catatan = $data->catatan;
        $data_tanggal = $data->tanggal_catatan;

        // Pemisahan data Catatan
        $fixed_data_catatan = explode('-- ', $data_catatan);

        if(count($fixed_data_catatan) === 1) {
            $fixed_data_catatan = [$data_catatan];
        }

        // Pemisahan data Tanggal Catatan
        $fixed_data_tanggal = explode(', ', $data_tanggal);

        if(count($fixed_data_tanggal) === 1) {
            $fixed_data_tanggal = [$data_tanggal];
        }

        return view('pages.lemkis.addNote', compact('data', 'title', 'fixed_data_catatan', 'fixed_data_tanggal'));

    }

    public function noteTable($id){

        $title = "LEMKIS's Note Table";

        $data = Lemkis::findOrFail($id);

        $data_catatan = $data->catatan;
        $data_tanggal = $data->tanggal_catatan;

        // Pemisahan data Catatan
        $fixed_data_catatan = explode('-- ', $data_catatan);

        if(count($fixed_data_catatan) === 1) {
            $fixed_data_catatan = [$data_catatan];
        }

        // Pemisahan data Tanggal Catatan
        $fixed_data_tanggal = explode(', ', $data_tanggal);

        if(count($fixed_data_tanggal) === 1) {
            $fixed_data_tanggal = [$data_tanggal];
        }

        return view('pages.lemkis.noteTable', compact('data', 'title', 'fixed_data_catatan', 'fixed_data_tanggal'));

    }

    public function saveNote(Request $request, $id){

        $catatanString = implode('-- ', $request->input('catatan', []));
        $tanggalString = implode(', ', $request->input('tanggal_catatan', []));

        $request->merge(['catatan' => $catatanString]);
        $request->merge(['tanggal_catatan' => $tanggalString]);

        $validatedData = $request->validate([
            'catatan' => 'nullable|string',
            'tanggal_catatan' => 'nullable|string'
        ]);

        $lemkis = Lemkis::where('id', $id)->update($validatedData);

        return redirect('/lemkis')->with('success', 'LEMKIS note added successfully!');

    }

}

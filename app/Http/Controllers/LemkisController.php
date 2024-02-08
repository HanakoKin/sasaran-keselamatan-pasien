<?php

namespace App\Http\Controllers;

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

    public function addLemkisPage(){

        $title = 'Lembar Kerja Investigasi Sederhana';

        return view('pages.lemkis.addLemkis', compact('title'));

    }

    public function store(Request $request){

        // dd($request);

        $validatedData = $request->validate([
            'penyebab_langsung' => 'required|string',
            'penyebab_awal' => 'required|string',
            'rekom_invest_pendek' => 'required|string',
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
            'direksi' => 'required|string',
            'asdir' => 'required|string',
            'timkes' => 'required|string',
            'personalia' => 'required|string',
            'invest_lengkap' => 'required|string',
            'tanggal_pengesahan' => 'required|date',
            'invest_lanjut' => 'required|string',
            'grading_akhir' => 'required|string',
        ]);


        Lemkis::create($validatedData);

        return redirect('/lemkis')->with('success', 'LEMKIS added successfully!');

    }


}

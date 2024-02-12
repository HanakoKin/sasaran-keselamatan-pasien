<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $response = Http::get('https://65b8b0d1b71048505a893410.mockapi.io/api/lapin/Pasien');
        $pasien = $response->json();

        return view('test.index', compact('pasien'));
    }

    public function search(Request $request)
    {
        $noRM = $request->input('noRM');

        // Lakukan permintaan ke API eksternal
        $response = Http::get('https://65b8b0d1b71048505a893410.mockapi.io/api/lapin/Pasien', [
            'noRM' => $noRM,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            // Jika data ditemukan, kembalikan sebagai respons
            if (!empty($data)) {
                return response()->json($data[0]);
            } else {
                return response()->json(['error' => 'Data pasien tidak ditemukan'], 404);
            }
        } else {
            return response()->json(['error' => 'Gagal melakukan permintaan ke API'], $response->status());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();

        // Contoh: kirimkan respons dengan data yang diterima
        return view('test.index', compact('data'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

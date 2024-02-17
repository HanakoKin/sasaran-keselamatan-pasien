<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

        $response = Http::get('https://0296fb61-00d6-4496-bd90-3b3c5f88503a.mock.pstmn.io/Pasien');

        if ($response->successful()) {
            $data = $response->json();

            // 4. Cocokkan noReg dengan Data Registration
            $registrationData = collect($data['registration']);
            $selectedRegistration = $registrationData->where('noReg', $noRM)->first();

            if ($selectedRegistration) {

                $informasiPasien = [
                    'nama' => $selectedRegistration['name'],
                    'jam_masuk' => $selectedRegistration['jam_masuk'],
                    'tanggal_masuk' => $selectedRegistration['tanggal_masuk'],
                    'penjamin' => $selectedRegistration['penjamin'],
                ];

                // 5. Cari Data rekamMedis dengan noRM yang Cocok
                $rekamMedisData = collect($data['rekamMedis']);
                $selectedRekamMedis = $rekamMedisData->where('noRM', $selectedRegistration['noRM'])->first();

                if ($selectedRekamMedis) {
                    // 6. Ambil Informasi dari rekamMedis
                    $informasiPasien['tanggal_lahir'] = $selectedRekamMedis['birthDate'];

                    $tanggalLahir = Carbon::parse($selectedRekamMedis['birthDate']);
                    $umur = $tanggalLahir->diffInMonths(Carbon::now());

                    if ($umur <= 1) {
                        $kategoriUmur = 'umur1';
                    } elseif ($umur > 1 && $umur <= 12) {
                        $kategoriUmur = 'umur2';
                    } elseif ($umur > 12 && $umur <= 60) {
                        $kategoriUmur = 'umur3';
                    } elseif ($umur > 60 && $umur <= 180) {
                        $kategoriUmur = 'umur4';
                    } elseif ($umur > 180 && $umur <= 360) {
                        $kategoriUmur = 'umur5';
                    } elseif ($umur > 360 && $umur <= 780) {
                        $kategoriUmur = 'umur6';
                    } elseif ($umur > 780) {
                        $kategoriUmur = 'umur7';
                    }

                    $informasiPasien['umur'] = $kategoriUmur;
                    $informasiPasien['jenis_kelamin'] = $selectedRekamMedis['gender'];

                    return response()->json($informasiPasien);

                } else {
                    // Handle jika rekamMedis tidak ditemukan
                    return response()->json(['error' => 'Rekam medis tidak ditemukan'], 404);
                }
            } else {
                // Handle jika noReg tidak ditemukan dalam data registration
                return response()->json(['error' => 'No Registrasi tidak ditemukan'], 404);
            }
        } else {
            // Handle jika request tidak berhasil
            return response()->json(['error' => 'Request tidak berhasil'], 404);
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

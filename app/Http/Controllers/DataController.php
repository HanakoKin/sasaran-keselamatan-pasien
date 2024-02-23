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

        $headers = [
            'Content-Type' => 'application/json',
            'ConsId' => 'husadati@gmail.com',
            'SecretKey' => 'husadaTI.123',
            'Authorization' => $request->header('Authorization'), // Ambil token dari header permintaan
        ];

        $api1Response = Http::withHeaders($headers)->get("http://10.1.10.7:6070/BipubApi/api/Reg/$noRM")->json();

        $informasiPasien = [];

        if (isset($api1Response['status']) && $api1Response['status'] === 'success') {

            // Ambil informasi dari API Pertama
            $informasiPasien['regDate'] = $api1Response['data']['regDate'];
            $informasiPasien['regTime'] = $api1Response['data']['regTime'];
            $informasiPasien['pasienName'] = $api1Response['data']['pasienName'];
            $informasiPasien['penjamin'] = $api1Response['data']['tipeJaminanName'];

            // Gunakan cURL atau Guzzle untuk mengakses API Kedua
            $api2Response = Http::withHeaders($headers)->get("http://10.1.10.7:6070/BipubApi/api/Pasien/{$api1Response['data']['pasienId']}")->json();

            // Periksa apakah nomor pasien ditemukan di API Kedua
            if (isset($api2Response['status']) && $api2Response['status'] === 'success') {

                // Ambil informasi dari API Kedua
                $informasiPasien['gender'] = $api2Response['data']['gender'];
                $informasiPasien['birthDate'] = $api2Response['data']['birthDate'];

                // Gender 0 untuk perempuan, 1 untuk laki-laki
                if ($informasiPasien['gender'] == 0){
                    $informasiPasien['gender'] = 'Perempuan';
                } else {
                    $informasiPasien['gender'] = 'Laki-laki';
                }

                // Hitung umur dari tanggal lahir
                $tanggalLahir = Carbon::parse($api2Response['data']['birthDate']);
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

                // Kirim data ke tampilan
                return response()->json($informasiPasien);
            } else {
                // Handle jika nomor pasien tidak ditemukan di API Kedua
                return response()->json(['error' => 'Nomor pasien tidak ditemukan'], 404);
            }
        } else {
            // Handle jika nomor registrasi tidak ditemukan di API Pertama
            return response()->json(['error' => 'Nomor registrasi tidak ditemukan'], 404);
        }


        // if ($response->successful()) {
        //     $data = $response->json();

        //     // 4. Cocokkan noReg dengan Data Registration
        //     $registrationData = collect($data['registration']);
        //     $selectedRegistration = $registrationData->where('noReg', $noRM)->first();

        //     if ($selectedRegistration) {

        //         $informasiPasien = [
        //             'nama' => $selectedRegistration['name'],
        //             'jam_masuk' => $selectedRegistration['jam_masuk'],
        //             'tanggal_masuk' => $selectedRegistration['tanggal_masuk'],
        //             'penjamin' => $selectedRegistration['penjamin'],
        //         ];

        //         // 5. Cari Data rekamMedis dengan noRM yang Cocok
        //         $rekamMedisData = collect($data['rekamMedis']);
        //         $selectedRekamMedis = $rekamMedisData->where('noRM', $selectedRegistration['noRM'])->first();

        //         if ($selectedRekamMedis) {
        //             // 6. Ambil Informasi dari rekamMedis
        //             $informasiPasien['tanggal_lahir'] = $selectedRekamMedis['birthDate'];

        //             $tanggalLahir = Carbon::parse($selectedRekamMedis['birthDate']);
        //             $umur = $tanggalLahir->diffInMonths(Carbon::now());

        //             if ($umur <= 1) {
        //                 $kategoriUmur = 'umur1';
        //             } elseif ($umur > 1 && $umur <= 12) {
        //                 $kategoriUmur = 'umur2';
        //             } elseif ($umur > 12 && $umur <= 60) {
        //                 $kategoriUmur = 'umur3';
        //             } elseif ($umur > 60 && $umur <= 180) {
        //                 $kategoriUmur = 'umur4';
        //             } elseif ($umur > 180 && $umur <= 360) {
        //                 $kategoriUmur = 'umur5';
        //             } elseif ($umur > 360 && $umur <= 780) {
        //                 $kategoriUmur = 'umur6';
        //             } elseif ($umur > 780) {
        //                 $kategoriUmur = 'umur7';
        //             }

        //             $informasiPasien['umur'] = $kategoriUmur;
        //             $informasiPasien['jenis_kelamin'] = $selectedRekamMedis['gender'];

        //             return response()->json($informasiPasien);

        //         } else {
        //             // Handle jika rekamMedis tidak ditemukan
        //             return response()->json(['error' => 'Rekam medis tidak ditemukan'], 404);
        //         }
        //     } else {
        //         // Handle jika noReg tidak ditemukan dalam data registration
        //         return response()->json(['error' => 'No Registrasi tidak ditemukan'], 404);
        //     }
        // } else {
        //     // Handle jika request tidak berhasil
        //     return response()->json(['error' => 'Request tidak berhasil'], 404);
        // }
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

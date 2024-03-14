<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rshusada;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RshusadaController extends Controller
{
    public function index()
    {
        $title = 'Sensus rshusada Page';

        return view('pages.sensus.rshusada.rshusada', compact('title'));
    }

    public function showData(Request $request)
    {
        $currentMonth = $request->input('month') ?? Carbon::now()->translatedFormat('F');
        $currentYear = $request->input('year') ?? now()->format('Y');

        $data = Rshusada::where('tahun', $currentYear)->where('bulan', $currentMonth)->get();

        // return response()->json([
        //     'data' => $data,
        // ]);

        $sensus = [];

        foreach ($data as $item) {

            // Gunakan explode pada atribut 'sensus'
            $sensusArray = explode(' -- ', $item->sensus);

            // Gabungkan hasil explode ke dalam array $sensus
            $sensus = array_merge($sensus, $sensusArray);
        }

        $mainArray = [];

        // Loop melalui stringData dan membagi setiap string menjadi array
        foreach ($sensus as $val) {
            $innerArray = explode(', ', $val);
            $mainArray[] = $innerArray;
        }

        $question = [
            'Ketidaktepatan identifikasi pasien rawat inap',
            'Ketidaktepatan identifikasi pasien rawat jalan',
            'Komunikasi kurang efektif',
            'Keamanan obat yang kurang diwaspadai',
            'Ketidakpatuhan cuci tangan',
            'Pasien jatuh',
            'Kesalahan transportasi pasien saat merujuk',
            'Kesalahan transportasi saat menjemput pasien',
            'Kesalahan jenis operasi',
            'Kesalahan posisi operasi',
            'Tertinggalnya kain kassa',
            'Tertinggalnya instrumen',
            'Operasi tanpa spesialis anestesi',
            'Operasi dengan kekurangan darah',
            'Konsultasi durante operasi',
            'Perluasan operasi',
            'Kesalahan diagnosis pra operasi',
            'Tersumbatnya saluran nafas yang berakibat bradicardi',
            'Kesalahan setting ventilator',
            'Vagal refleks pada pemasangan ET',
            'Infus blong',
            'Trauma elektrik',
            'Kesalahan pemberian informasi kepada dokter',
            'Kesalahan sampling',
            'Kesalahan persiapan pemeriksaan penunjang',
            'Kesalahan persiapan operasi',
            'Luka bakar akibat buli – buli panas',
            'Kesalahan golongan darah',
            'Kesalahan jenis darah',
            'Perbedaan hasil skrining',
            'Kesalahan posisi pemeriksaan',
            'Reaksi obat kontras',
            'Kesalahan pembacaan resep',
            'Kesalahan penyerahan obat',
            'Ketidakjelasan tulisan pada rekam medis',
            'Luka bakar akibat diatermi',
            'Kesalahan cara pemberian obat',
            'Kesalahan pencampuran obat',
            'Kesalahan dosis obat',
            'Kesalahan identifikasi pasien pada saat pengambilan sample',
            'Kesalahan pemberian obat',
            'Kesalahan pemberian informasi harga alat kesehatan',
            'Ketidaktepatan teknik pengambilan sample darah',
            'Luka bakar akibat pemasangan Bicnat Drip (100 CC)',
            'Reaksi efek samping obat',
            'Reaksi efek samping transfusi darah',
        ];

        $evenDayMonths = ['April', 'Juni', 'September', 'November'];

        if ($currentMonth == 'Februari' && ($currentYear % 4 == 0 && $currentYear % 100 != 0) || $currentYear % 400 == 0) {
            $totalDay = 29;
        } else if ($currentMonth == 'Februari' && $currentYear % 4 != 0) {
            $totalDay = 28;
        } else if (in_array($currentMonth, $evenDayMonths)) {
            $totalDay = 30;
        } else {
            $totalDay = 31;
        }

        $response = [
            'title' => 'Sensus rshusada Page',
            'question' => $question,
            'data' => $data,
            'mainArray' => $mainArray,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
            'totalDay' => $totalDay,
        ];

        return response()->json($response);
    }

    public function add()
    {
        $title = 'Add Sensus rshusada Page';

        return view('pages.sensus.rshusada.addRshusada', compact('title'));
    }

    public function store(Request $request)
    {

        // dd($request);

        $totalDay = $request->jml_hari;

        $inputArray = $request->sensus;

        $sensusString = implode(', ', $inputArray);
        $sensusString = '';
        foreach ($inputArray as $index => $value) {
            // Set pemisah berdasarkan indeks
            $separator = ((($index) % $totalDay) === $totalDay - 1) ? ' -- ' : ', ';

            // Tambahkan nilai dan pemisah ke string
            $sensusString .= $value . $separator;
        }

        // Hapus pemisah ekstra di akhir string
        $sensusString = rtrim($sensusString, ', --');
        $request->merge(['sensus' => $sensusString]);

        $validatedData = $request->validate([
            'jml_hari' => 'string',
            'bulan' => 'string',
            'tahun' => 'string',
            'sensus' => 'string',
        ]);

        $data = Rshusada::where('tahun', $request->tahun)->where('bulan', $request->bulan)->first();

        if (isset($data)) {
            $data->update($validatedData);
        } else {
            Rshusada::create($validatedData);
        }

        return redirect('/sensus/rshusada')->with('success', 'Sensus added successfully!');
    }
}

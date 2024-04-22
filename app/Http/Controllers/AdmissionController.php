<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Admission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdmissionController extends Controller
{
    public function index()
    {
        $title = 'Sensus admission Page';

        return view('pages.sensus.admission.admission', compact('title'));
    }

    public function showData(Request $request)
    {
        $currentMonth = $request->input('month') ?? Carbon::now()->translatedFormat('F');
        $currentYear = $request->input('year') ?? now()->format('Y');

        $data = Admission::where('tahun', $currentYear)->where('bulan', $currentMonth)->get();

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
            'Kesalahan penulisan nama pada pendaftaran pasien baru',
            'Kesalahan pemasangan gelang pasien baru',
            'Pasien baru yang tidak terpasang gelang identitas',
            'Kesalahan penulisan nama DPJP',
            'Kesalahan penulisan diagnosa',
            'Tulisan DPJP tidak terbaca dengan jelas di surat rawat',
            'Kesalahan pemberian informasi kepada pasien',
            'Kesalahan jenis operasi',
            'Kesalahan posisi operasi',
            'Ketidakpatuhan cuci tangan',
            'Pasien jatuh'
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
            'title' => 'Sensus admission Page',
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
        $title = 'Add Sensus admission Page';

        return view('pages.sensus.admission.addAdmission', compact('title'));
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

        $admission = Admission::where('tahun', $request->tahun)->where('bulan', $request->bulan)->first();

        if (isset($admission)) {
            $admission->update($validatedData);
        } else {
            Admission::create($validatedData);
        }

        return redirect('/sensus/admission')->with('success', 'Sensus added successfully!');
    }
}
